import FaiModule from '../FaiModule.js';
export default class ContentProcessing extends FaiModule {
    constructor() {
        super();





    }

    async setModule(key, value) {
        this[key] = value;
    }
    async executeContentLogic(array, i, data = {}, temp_dataRow = {}, temp_array = {}) {
        const item = array[i];
        const func = item[0];
        const type = item[1];
        if (!func && !type) return "";
        await this.initContent();
        let temp_content = await this.logicContent(item, func, type, data);
        let rowData = await this.getModule("CoreDatabase").databaseConverter(temp_content, data);
        if (temp_array.length) {
            temp_content.array = temp_array;
        }
        if (temp_dataRow.length) {
            rowData = temp_dataRow;
        }

        return await this.renderContentWithData(temp_content, rowData, temp_content.content);

    }
    async initContent() {
        // temp_content = {
        //     content: {
        //         html: "",
        //         css: "",
        //         js: ""
        //     }
        // };
    }
    async logicContent(item, func, type, data) {
        let temp_content = {
            content: {
                html: "",
                css: "",
                js: ""
            }
        };
        switch (func) {
            case 'bundle':
                if (item[-1] == 'BE3-LINK-LOGIN') {
                    temp_content.content.html = "javascript:open_login()";
                } else if (item[-1] == 'BE3-LINK-DAFTAR') {
                    temp_content.content.html = "javascript:open_register()";
                } else if (item[1] == 'logo') {
                    temp_content.content.html =
                        this.getModule("base_url_non_index") + 'uploads/' + this.getModule("versionContent").web.logo;
                } else if (item[-1] == 'BE3-LINK-LOGOUT') {

                    temp_content.content.html = "javascript:jsLogout()";
                } else if (item[1] == 'base_url_non_index') {

                    temp_content.content.html = this.getModule("base_url_non_index");
                } else if (item[1] == 'base_url_non_index_upload') {

                    temp_content.content.html = this.getModule("base_url_non_index") + 'uploads/';
                } else if (item[1] == 'date_now' || type == 'date_now') {
                    const today = new Date().toISOString().slice(0, 10); // 2025-11-16 misalnya
                    temp_content.content.html = today;
                }
                break;
            case 'text':
                temp_content.content.html = type;
                break;

            case 'database':
                if (type in data) {
                    temp_content.content.html = data[type] || "";
                } else {
                    temp_content.content.html = "";
                }
                break;

            case 'get_data_harga':
                temp_content.content.html = "";
                break
            case 'drive_file_db':
                temp_content.content.html = "";
                break
            case 'user_info':
                // const user = await getDataFromDB('content', 'user_info');
                temp_content.content.html = '';
                break;
            case 'pages_content':
                let result_pages_content;
                let pages_content_item = btoa(unescape(encodeURIComponent(JSON.stringify(item))));
                temp_content.content.html = "<div id='pages_content' data-pages_content_item='" + pages_content_item + "' ></div>" +
                    "<div id='search_result_content' style='display:none'></div>";
                break;

            case 'link':

                const encoded = await btoa(JSON.stringify(type));
                const enPage = await this.getModule("linkHelper").encodeDataForHref(data);;;
                temp_content.content.html = "javascript:void(link_direct('" + encoded + "','" + enPage + "'))";
                break;
            case 'produk':
                let storeName = item.refer_db;
                const array_set = [];
                let bodyReq = {};
                bodyReq.db = 'view_produk_detail';
                bodyReq.function = 'all_produk';

                if (item.pagination.limit) {
                    bodyReq.limit_function = item.pagination.limit;
                }
                if (item.pagination.order_by) {
                    bodyReq.orderBy = {
                        field: item.pagination.order_by[0],
                        direction: item.pagination.order_by[1]
                    };
                }
                if (this.getModule('searchData')) {
                    console.log("searchData", this.getModule('searchData'));
                    let whereClause = [];
                    whereClause.push({
                        fields: item.search?.field,
                        operator: 'like_or_fields',

                        value: `%${this.getModule('searchData').keyword}%`
                    });

                    bodyReq.where = whereClause
                }
                bodyReq.select = ["primary_key"];
                bodyReq.group = ["primary_key"];
                bodyReq.limit = 30;
                console.log('bodyReq', bodyReq);
                let allData = await this.getModule('Data').loadJSON('view_produk_detail', bodyReq);
                //allData = Object.entries(Data);
                //console.log('allData',allData);
                //allData =  await ParseAllData(data, {});;
                const array_template = [{
                    0: item.func_content,
                    1: item.content,
                    return: "html_content"
                },

                ];
                const pattern = new RegExp('<VARIABLE></VARIABLE>', 'gi');
                const className = item?.include_in_id?.class || '';


                let result_template = await this.getModule('ContentProcessing').executeContentLogic(array_template, 0);
                result_template.html = result_template.html.replace(pattern, item.variable);

                let after = item?.include_in_id?.after || '';
                temp_content.content.html = '<div id="content-' + item.variable + '"  class="' + className + '" onload="appendData(\'' + item.variable + '\', 1);"></div>';
                let is_pagination = true;

                if (item.pagination.page == 'none')
                    is_pagination = false;
                if (is_pagination) {
                    let itemIndex = item.variable;
                    temp_content.content.html += `
                        <button 
                            id="loadMore_${item.variable}" 
                            class="btn btn-primary btn-sm mt-2"
                            onclick="(function() {
                                const btn = this;
                                const page = parseInt(btn.dataset.page || '1');
                                const nextPage = page + 1;
                                btn.dataset.page = nextPage;
                                btn.disabled = true;
                                
                                
                                window.fai.getModule('ListDataHub').appendData('${itemIndex}', nextPage)
                                    .finally(() => {
                                        btn.disabled = false;
                                        btn.textContent = 'Load More Page ' + nextPage;
                                    });
                            }).call(this)"
                            data-page="1"
                        >
                            Load More
                        </button>
                        
                        <div id="loading_${item.variable}" class="d-none mt-2">
                            <div class="spinner-border text-primary"></div>
                        </div>
                    `;
                }
                temp_content.content.html += `
                    <div class="text-center mt-2" id="loading_${item.variable}" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    `;
                // temp_content.content.html += '<div class="text-center " id="loading"><div class="spinner"></div></div>';

                temp_content.content.js += `
                    <script>

                    </script>

                `;

                //let allData = await getAllFromStore(db, {
                //    utama: storeName
                //}, storeName);
                if (allData && typeof allData === 'object') {
                    const sorted = Object.values(allData).sort((a, b) => {
                        return new Date(b.create_date) - new Date(a.create_date);
                    });

                    // console.log(sorted);
                } else {
                    console.warn("Data 'row' kosong atau tidak berbentuk object.");
                }

                await this.setProdukModules(item, allData, result_template);


                break;
            case 'row_web_apps':
                temp_content.content.html = "";

                if (this.getModule("versionContent").web[type]) {

                    temp_content.content.html = this.getModule("versionContent").web[type];
                }
                break;
            case 'menu':
                let get_list_menu;
                let encoded_link;
                let link;
                let enPage_link;
                temp_content.content.html = "";
                if (item.list.tipe == 'menu_func') {
                    let last_version = this.getModule("versionContent").menu_list.versions[item.list.func].last_version;

                    get_list_menu = await this.getModule("versionContent").menu_list.versions[item.list.func].versions[last_version];

                    // this.getModule("versionContent").menu_list
                }
                console.log(get_list_menu);
                // console.log(get_list_menu[this.getModule("versionContent").load.domain].public[item.list.var]);


                for (const r_menu of get_list_menu[this.getModule("versionContent").load.domain]['public'][item.list.var]) {
                    temp_content.content.html += item.configuration.prefix.menu + r_menu['nama'] + item.configuration
                        .sufix.menu;
                    link = r_menu;
                    encoded_link = btoa(JSON.stringify(link));
                    enPage_link = this.getModule("linkHelper").encodeDataForHref(data);;;
                    temp_content.content.html = temp_content.content.html.replace(`|LINK|`,
                        "javascript:void(link_direct('" + encoded_link + "','" + encoded_link + "'))");
                }

                break;

            case 'base_url':
                temp_content.content.html = this.getModule("base_url");
                break;


            case 'if_database_to_text':

                const value = data[item.row];

                // Cek apakah value cocok
                let result = item.if_else;
                if (value in item.if_value) {
                    result = item.if_value[value];
                }
                temp_content.content.html = result;
                break;
            case 'crud':
                temp_content.content.html = await renderCrudComponent(item, page);
                break;
            case 'list_menu_board':
                let apiEndpoint = await this.getModule("base_url") + "api/get_menu_board/";
                let dataApi = await this.getModule("urlHelper").fetchDataFromApi(apiEndpoint, 'GET',
                    {
                        id_board: this.getModule('domainDetail').id_board

                    });
                console.log('list_menu_board', dataApi);
                temp_content.content.html = dataApi.html;
                break;

            case 'view_to_js':
                return renderDynamicJSView(item, page, array, i);
            case 'menu_content':
                set_type = item[2];
                // console.log("Type :" + type);
                last_version = this.getModule("versionContent").menu.versions[type].last_version;

                temp_content = await this.getModule("versionContent").menu.versions[type].versions[last_version][set_type];
                break;
            default:
                // console.log('INI GARIS CONTENT');
                console.log('func', func);
                console.log('type', type);
                // console.log('this.getModule("versionContent")', this.getModule("versionContent")); 
                let last_version = this.getModule("versionContent").data.versions[func].last_version;

                if (this.getModule("versionContent").data.versions[func].versions[last_version][type]) {

                    // console.log(this.getModule("versionContent").data.versions[func].versions[last_version][type]);
                    temp_content = await this.getModule("versionContent").data.versions[func].versions[last_version][type];
                } else {

                    temp_content.content.html = '';
                }

                //$content = self::$function($page, $type, $array[$i], $data)[$type];

                break;
        }
        return temp_content;
    }
    async initIfNull(key, defaultValue) {
        let mod = await this.getModule(key);
        if (!mod) {
            await this.setModule(key, defaultValue);
            mod = await this.getModule(key);
        }
        return mod;
    }
    async setProdukModules(item, allData, result_template) {
        const variable = item.variable;
        const corePages = this.getModule('CorePages');
        const data_produk = await this.initIfNull("data_produk", {});
        const data_produk_real = await this.initIfNull("data_produk_real", {});
        const data_array = await this.initIfNull("data_produk_array", {});
        const data_itemsPerPage = await this.initIfNull("data_produk_itemsPerPage", {});
        const data_content = await this.initIfNull("data_produk_content", {});
        const data_search_field = await this.initIfNull("data_produk_search_field", {});
        let data_after_init = await this.initIfNull("data_produk_after_init", []);
        let is_search = true;
        // Set datanya
        data_produk[variable] = allData;
        data_produk_real[variable] = allData;
        data_array[variable] = item.array;
        data_itemsPerPage[variable] = item.pagination?.limit || 10;
        data_content[variable] = result_template.html;
        data_search_field[variable] = item.search?.field || "";
        // Tambahkan init_produk
        data_after_init.push(() => this.getModule('ListDataHub')?.init_produk(variable));
        corePages.registerAfterInit("ListDataHub", "init_produk", [variable, data_search_field[variable], data_itemsPerPage[variable]]);
        // Jika ada header search
        // this.getModule('ListDataHub').initSearchListenersProduk(variable);
        let array_header = item.search?.header;
        if (array_header && typeof array_header === 'object' && Object.keys(array_header).length > 0) {

            const encodedHeader = btoa(unescape(encodeURIComponent(JSON.stringify(array_header))));
            corePages.registerAfterInit("ListDataHub", "proses_search_produk", [
                'header',
                variable,
                encodedHeader
            ]);

        }


        // Jika non-search diaktifkan
        if (item.search?.non_search) {
            data_after_init.push(() => this.getModule('ListDataHub')?.no_search_produk('search', variable));
            corePages.registerAfterInit("ListDataHub", "no_search_produk", [
                'search',
                variable
            ]);
        }

        // Sidebar
        let array_sidebar = item.search?.sidebar;
        if (array_sidebar && typeof array_sidebar === 'object' && Object.keys(array_sidebar).length > 0) {
            const encodedSidebar = btoa(unescape(encodeURIComponent(JSON.stringify(array_sidebar))));
            data_after_init.push(() => {
                this.getModule('ListDataHub')?.proses_search_produk('sidebar', variable, encodedSidebar);
            });
            corePages.registerAfterInit("ListDataHub", "proses_search_produk", [
                'sidebar',
                variable,
                encodedSidebar
            ]);
        } else {
            data_after_init.push(() => this.getModule('ListDataHub')?.no_search_produk('sidebar', variable));
            corePages.registerAfterInit("ListDataHub", "no_search_produk", [
                'sidebar',
                variable
            ]);
        }

        // Tambahkan appendData
        data_after_init.push(() => this.getModule('ListDataHub')?.appendData(variable, 0));
        corePages.registerAfterInit("ListDataHub", "appendData", [variable, 0]);
        // () => {
        //     return this.getModule('ListDataHub')?.appendData(variable, 0);
        // }
        // Tambahkan fungsi inisialisasi


        // Update kembali ke module jika perlu (karena array/obj by ref, bisa optional)
        await this.setModule("data_produk", data_produk);
        await this.setModule("data_produk_real", data_produk_real);
        await this.setModule("data_produk_array", data_array);
        await this.setModule("data_produk_itemsPerPage", data_itemsPerPage);
        await this.setModule("data_produk_content", data_content);
        await this.setModule("data_produk_search_field", data_search_field);
        await this.setModule("data_produk_after_init", data_after_init);

    }

    async renderContentWithData(content, dataRows, templateString, pagination = {
        type: "load_more",
        limit: 50,
        page: 1
    }) {

        return await this.getModule('ContentRenderer').renderContentWithData(content, dataRows, templateString, pagination);
    }
}

export class ContentRenderer extends FaiModule {
    constructor() {
        super();
    }
    async setModule(key, value) {
        this[key] = value;
    }
    async renderContentWithData(content, dataRows, templateString, pagination = {
        type: "load_more",
        limit: 50,
        page: 1
    }) {



        const all_result_get = {
            html: "",
            css: "",
            js: ""
        };

        const tagNamebe3temp = "BE3-LINK-TEMPLATE";
        const patternbe3template = new RegExp(`<${tagNamebe3temp}></${tagNamebe3temp}>`, 'gi');
        const templateUrl = this.getModule("base_url_non_index") + "FaiFramework/Pages/_template/";

        // Pre-process template
        for (const type of ['css', 'html', 'js']) {
            if (templateString[type]) {
                templateString[type] = templateString[type]
                    .replace(patternbe3template, templateUrl)
                    .replace(/{HTTPS}/gi, "https")
                    .replace(new RegExp(this.getModule("base_url") + "FaiFramework/Pages/_template/", 'gi'), templateUrl);
            }
        }

        const rows = dataRows?.row || {};
        const allKeys = Object.keys(rows);
        const totalRows = allKeys.length;

        let start = 0;
        let end = totalRows;
        if (pagination.type === "load_more" || pagination.type === "page") {
            const limit = pagination.limit || 50;
            const pageNum = pagination.page || 1;
            start = (pageNum - 1) * limit;
            end = Math.min(start + limit, totalRows);
        }

        const paginatedKeys = allKeys.slice(start, end);


        for (const key of paginatedKeys) {
            const row = rows[key];

            let returnTemp = {
                css: templateString.css || "",
                js: templateString.js || "",
                html: templateString.html || ""
            };

            if (content.array) {
                for (let keyArray in content.array) {
                    const value = content.array[keyArray];
                    let array = [[]];

                    for (let key2 in value) {
                        let fixedKey = isNaN(key2) ? key2 : parseInt(key2) - 1;
                        array[0][fixedKey] = value[key2];
                    }

                    const rendered = await this.getModule("ContentProcessing").executeContentLogic(array, 0, row);

                    const tagName = content.array[keyArray][0];
                    const pattern = new RegExp(`<${tagName}></${tagName}>`, 'gi');

                    returnTemp.css = returnTemp.css.replace(pattern, rendered.css || "");
                    returnTemp.html = returnTemp.html.replace(pattern, rendered.html || "");
                    returnTemp.js = returnTemp.js.replace(pattern, rendered.js || "");
                }
            }

            all_result_get.js += returnTemp.js;
            all_result_get.html += returnTemp.html;
            all_result_get.css += returnTemp.css;
        }

        return all_result_get;
    }

    // Bisa ditambahkan method render lainnya di sini
    async renderSimpleContent(content, data = {}) {

        const processor = new ContentProcessing();

    }
}