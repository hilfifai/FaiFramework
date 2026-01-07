
import FaiModule from '../FaiModule.js';
export default class CorePages extends FaiModule {
    constructor() {
        super();
        this.after_init = [];
        this.afterInitEvents = [];
    }
    async setModule(key, value) {
        this[key] = value;
    }
    async addAfterInit() {
        this.after_init.push();
    }
    async proses_pages_content(item_j, page_j) {
        await this.getModule("loaderBuilder").sekeleton('pages_content');
        const raw = decodeURIComponent(escape(atob(item_j)));
        const item = JSON.parse(raw);
        const page = this.versionContent;

        let content = {
            content: {
                html: "",
                js: "",
                css: "",
            }
        }
        // alert();
        console.log("items", item);
        console.log("page", page);
        let result_pages_content = await this.pages_content(item, page);
        // content.content = result_pages_content;;
        $('#pages_content').html(result_pages_content.css + " " + result_pages_content.html + " " + result_pages_content
            .js);

        await this.proses_after_init();


    }
    async processPages() {
        let GetLink = await this.getModule('linkHelper').getLink();
        const section = GetLink.section;
        const page = GetLink.page;
        const id = GetLink.id;
        const parts = GetLink.parts;

        if (section === "home") {
            let pages_content_item = $('#pages_content').data("pages_content_item");
            return await this.proses_pages_content(pages_content_item);
        } else if (section === "cart") {
            const encoded = btoa(JSON.stringify(["Ecommerce", "cart", "view_layout", -1]));
            const enPage = this.getModule("linkHelper").encodeDataForHref([{ object: 'foreach_1_row' }]);
            await this.link_direct(encoded);
        } else if (section == 'produk') {
            const db = await openDB(transaksiDB, "web__list_apps_menu");
            const allData = await getAllFromStore(db, {
                "utama": "view_produk_detail"
            }, "view_produk_detail", {
                "id_search": id
            });
            const item = allData[id];
            const json = btoa(unescape(encodeURIComponent(JSON.stringify(item))));

            setTimeout(function () {
                const el = document.querySelector('.job-card[data-id="' + id + '"]');
                show_produk(el, json);
            }, 1000);
        } else {
            const data = [{ object: 'foreach_1_row' }];
            if (parts[3] == 'view-layout') {
                parts[3] = "view_layout";
            }
            const type = {
                0: parts[0],
                1: parts[1],
                2: parts[2],
                3: parts[3],
                4: parts[4],
                5: parts[5],
                6: parts[6],
                7: parts[7],
                8: parts[8],
                9: parts[9],
            };

            const encoded = btoa(JSON.stringify(type));
            const enPage = await this.getModule("linkHelper").encodeDataForHref(data);
            await this.link_direct(encoded);
        }
    }
    async processPa2ges() {
        const currentUrl = window.location.href;
        const data_link = await this.getModule("linkHelper").getLastPathSegment(currentUrl, this.getModule("base_url"));
        const viewpage = await this.getModule("linkHelper").decodeDataFromHref(data_link);
        const parts = viewpage;
        console.log("viewpage", viewpage);


        const section = await this.getModule("linkHelper").replace_stript(viewpage[0]) || null;
        const page = await this.getModule("linkHelper").replace_stript(viewpage[1]) || null;
        const id = await this.getModule("linkHelper").replace_stript(viewpage[2]) || null;

        if (section === "home") {
            // console.log(getalldata.pages_content);
            let pages_content_item = $('#pages_content').data("pages_content_item");
            return await this.proses_pages_content(pages_content_item);

        } else
            if (section === "cart") {
                const encoded = btoa(JSON.stringify(["Ecommerce", "cart", "view_layout", -1]));
                const enPage = this.getModule("linkHelper").encodeDataForHref([{
                    object: 'foreach_1_row'
                }]);;;
                await this.link_direct(encoded);

            } else if (section == 'produk') {


                const db = await openDB(transaksiDB, "web__list_apps_menu");
                // console.log("ini page_div", page_div);
                const allData = await getAllFromStore(db, {
                    "utama": "all_produk"
                },
                    "all_produk", {
                    "id_search": id
                });
                item = allData[id];
                // console.log("ini item", item);
                json = btoa(unescape(encodeURIComponent(JSON.stringify(item))));
                setTimeout(function () {
                    const el = document.querySelector('.job-card[data-id="' + id + '"]');
                    show_produk(el, json);
                }, 1000);

            } else {
                const data = [{
                    object: 'foreach_1_row'
                }];
                if (parts[3] == 'view-layout') {
                    parts[3] = "view_layout";
                }
                const type = {
                    0: parts[0],
                    1: parts[1],
                    2: parts[2],
                    3: parts[3],
                    4: parts[4],
                    5: parts[5],
                    6: parts[6],
                    7: parts[7],
                    8: parts[8],
                    9: parts[9],
                };
                // console.log(type);
                const encoded = btoa(JSON.stringify(type));
                const enPage = await this.getModule("linkHelper").encodeDataForHref(data);;;
                await this.link_direct(encoded);
            }
    }

    async cleanupBeforeRender() {
        // Hapus semua event listener yang mungkin terpasang
        $(document).off('click', '#loadMoreButton');
        $(document).off('click', '.btn-primary');

        // Reset state modules
        const modulesToReset = [
            "data_produk", "data_produk_real", "data_produk_array",
            "data_produk_itemsPerPage", "data_produk_content",
            "data_produk_search_field", "data_produk_after_init","data_produk_search_header"
        ];

        for (const moduleName of modulesToReset) {
            await this.setModule(moduleName, moduleName.includes('array') ? [] : {});
        }

        // Reset after_init array
        this.after_init = [];
    }
    async link_direct(encoded) {
        //try {
        this.afterInitEvents = [];
        await this.setModule('data_produk_after_init', []);
        // await this.getModule("loaderBuilder").sekeleton('pages_content');
        await this.cleanupBeforeRender();
        const data = await this.getModule("linkHelper").decodeDataFromHref(encoded);;;
        console.log("link", data);



        let page = this.getModule('versionContent');

        let apps = data[0];
        let page_view = data[1];
        let load_type = data[2];
        let load_page_id = data[3];
        let menu = data[4] ?? '-1';
        let nav = data[5] ?? '-1';
        let board = data[6] ?? '-1';
        let load_type_temp = load_type;

        page_view = page_view.replace(/-/g, "_");
        load_type_temp = load_type_temp.replace(/-/g, "_");
        load_type = load_type.replace(/-/g, "_");

        window.history.pushState({}, '', '/app2/' + (await this.getModule('linkHelper').encodeDataForHref(data)));

        console.log(apps);
        console.log(page_view);

        let versions = page.app.versions[apps][page_view];
        let last_version = versions.last_version;
        let view = versions.versions[last_version];

        view.page["load"] = {
            apps: apps,
            page_view: page_view,
            load_type: load_type,
            load_page_id: load_page_id,
            menu: menu,
            nav: nav,
            board: board,
        };

        page["view"] = view.page;
        this.setModule('versionContent', page);
        console.log("page", page);

        let content = await this.Page(page, load_type, load_page_id, menu);

        if (content != -1) {
            $('#pages_content').empty("");
            $('#pages_content').html(content.css + " " + content.html + " " + content.js);

            const container = document.createElement('div');
            container.innerHTML = content.css + " " + content.html + " " + content.js;

            const scripts = container.querySelectorAll('script');
            scripts.forEach(script => {
                const newScript = document.createElement('script');

                if (script.src) {
                    newScript.src = script.src;
                } else {
                    newScript.textContent = script.textContent;
                }

                document.body.appendChild(newScript);
            });

            // Perbaikan: panggil method yang benar
            await this.proses_after_init();
        }
        //} catch (e) {
        //   console.error("Message:", e.message);
        //   console.error("Stack:\n", e.stack);
        //}
    }

    async proses_after_init() {
         const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    $('.content-login').show();
    $('.content-notlogin').hide();
  }else{
    $('.content-login').hide();
    $('.content-notlogin').show();

  }
        console.log("afterInitArray", this.afterInitEvents);
        for (const { module, method, args } of this.afterInitEvents) {
            try {
                const moduleInstance = this.getModule(module);
                if (moduleInstance && typeof moduleInstance[method] === 'function') {
                    console.log(`Executing: ${module}.${method}`, args);
                    await moduleInstance[method](...args);
                } else {
                    console.warn(`Method not found: ${module}.${method}`);
                }
            } catch (e) {
                console.error(`Error in ${module}.${method}:`, e);
            }
        }

        // Optional: Clear setelah execute
        this.afterInitEvents = [];

    }
    registerAfterInit(moduleName, methodName, args = []) {
        this.afterInitEvents.push({
            module: moduleName,
            method: methodName,
            args: Array.isArray(args) ? args : [args]
        });
    }
    async pages_content(item) {
        try {
            await this.cleanupBeforeRender();
            let content = {
                html: "INI KONTENT",
                css: "",
                js: ""
            };
            //cari first loginnya
            let page = this.getModule("versionContent");
            let domain = (page.load.domain);
            let first = (page.load.first_page);
            let first_page;
            if (page.web.id_first_menu)
                first_page = page.web.id_first_menu;
            else if (page.load.first_page)
                first_page = (page.load.first_page);


            const allData = await this.getModule("CoreDatabase").getAllFromStore({
                "utama": "web__list_apps_menu"
            },
                "web__list_apps_menu", {
                "id_search": first_page,
                "live": 2
            });

            const apps = allData[first_page].load_apps;
            const page_view = allData[first_page].load_page_view;
            const load_type = allData[first_page].load_type;
            const load_page_id = allData[first_page].load_page_id;
            const menu = allData[first_page].menu;
            const nav = allData[first_page].nav;
            const board = allData[first_page].board;
            console.log("first_page",first_page);
            const versions = page.app.versions[apps][page_view];
            const last_version = versions.last_version;
            const view = versions.versions[last_version];
            let toPage;
            toPage = window.fai.getModule("versionContent");;
            if (!toPage.view) {
                toPage.view = {};
            }
            if (!toPage.view.load) {
                toPage.view.load = {};
            }
            toPage.view.load = {
                apps: apps,
                page_view: page_view,
                load_type: load_type,
                load_page_id: load_page_id,
                menu: menu,
                nav: nav,
                board: board,
                board: board,
            };
            console.log("toPage",toPage);
            console.log("toPage",toPage.view.load);
            this.setModule("versionContent", toPage);



            page["view"] = view.page;
            content = await this.Page(page, load_type, load_page_id, menu);

            return content;
        } catch (error) {
            // document.getElementById('app').innerHTML = 'Error loading data.';
            console.error('Terjadi error:', error); // tampilkan pesan error dan stack
            console.log('Pesan:', error.message); // hanya pesan
            console.log('Stack trace:\n' + error.stack); // hanya trace
        }
    }
    async Page(page, type, id, section_menu = '-1') {

        const pkg = this._packages;

        page.section = page.section || 'page';
        page.database_provider = page.database_provider || 'mysql';
        page.app_framework = page.app_framework || 'ci';
        const login = page.require_login;

        if (type === 'delete_privilage') {
            type = 'hapus';
        }

        if (type === 'enskripsi') {
            return de(Partial.input('text', '_POST'));
        }

        const crudTypes = [
            'unique_value', 'diferent_value', 'wizard_form'
        ];

        const loginTypes = ['get_login', 'check_login'];
        const layoutTypes = ['view_layout', 'load_data'];
        const sync = ['sync', 'sync_edit'];
        const orderSystem = ['order_system'];
        const ajaxTypes = ['js_ajax'];
        const crudFullTypes = [
            'setting', 'save_setting', 'list_datatable', 'tambah', 'edit', 'edit_approval',
            'update_approval', 'view', 'list', 'hapus', 'save', 'appr', 'update',
            'tree_sub_kategori', 'field_value_automatic_sub_kategori', 'ajax_sub_kategori',
            'decline_appr', 'setujui_appr', 'PDFPage', 'pdf', 'import_excel', 'export_existing',
            'export_empty', 'field_value_automatic', 'result_array_website',
            'field_value_automatic_select_target', 'field_view_sub_kategori',
            'insert_number_code', 'modalform_sub_kategori_add', 'import', 'template_import',
            'execution_import', 'select2'
        ];
        const daftarTypes = ['daftar', 'save_daftar'];
        const arrayWebsiteTypes = ['datatable_array_website'];
        const privilageTypes = ['delete_privilage', 'info_privilage'];
        const datatableTypes = ['datatable'];
        const syncTypes = ['sync', 'cari_sync', 'produk_sync'];
        const searchTypes = ['search_load'];
        const habitTypes = ['habittable', 'save_lapor_habits'];
        const ecommerceTypes = [
            'list_alamat_user', 'jadikan_default_pengiriman', 'list_cart', 'save_pengiriman_ke',
            'gunakan_voucher', 'add_cart', 'excel_produk', 'select_varian', 'select_varian_cart',
            'cek_harga_cart_get_checkout', 'delete_cart', 'update_pemesanan', 'get_all_ongkir',
            'get_change_ongkir', 'print_pesanan'
        ];
        const erpTypes = ['select_order'];
        const chatTypes = [
            'chat', 'kirim_pesan', 'list_pesan', 'list_chat_room', 'list_buat_chat_room',
            'to_chat_room', 'content_message', 'tambah_chat_personal', 'tambah_chat_grup'
        ];

        if (crudTypes.includes(type)) {
            return await CRUDFunc[type](fai, page, type, id);
            // } else if (!login || loginTypes.includes(type)) {
            //     return await pkg.login(page, type, id);
        } else if (orderSystem.includes(type)) {
            console.log('orderSystem', page);
            const config = page.app.page;
            await this.getModule("OrderSystemBuilder").init(config);
            await this.getModule("OrderSystemBuilder").showView(page.view.load.menu);
            return -1; // Tambahkan return value
        } else if (layoutTypes.includes(type)) {
            console.log('MASUK VIEW LATOUR');
            const getviewLayout = await this.getModule("ViewLayout").init(page, type, id, section_menu);

            return getviewLayout;
        } else if (ajaxTypes.includes(type)) {
            return await pkg.js_ajax(page, type, id, section_menu);
        } else if (crudFullTypes.includes(type)) {
            const config = {
                containerId: "pages_content",
                modalId: 'dataModal',
                version: this.getModule('version'),
                backendUrl: this.getModule('base_url') + 'api/crud/',
                apiUrl: "",
                api_token: "",
                page: page.view
            };
            await this.getModule('crudBuilder').CrudConfig(config);
            await this.getModule('crudBuilder').init();
            return -1;
        } else if (sync.includes(type)) {
            let backendUrl;

            backendUrl = this.getModule('base_url') + 'api/' + page.view.api_user.sync[page.view.load.load_page_id].backendUrl.type + '?key=' + page.view.api_user.sync[page.view.load.load_page_id].backendUrl.link;

            const config = {
                containerId: "pages_content",
                modalId: 'dataModal',
                version: this.getModule('version'),
                backendUrl: backendUrl,
                apiUrl: "",
                api_token: "",
                page: page.view.api_user.sync[page.view.load.load_page_id]
            };

            await this.getModule('crudBuilder').CrudConfig(config);
            await this.getModule('crudBuilder').init();
            return -1;
        } else if (daftarTypes.includes(type)) {
            return await pkg.login(page, type, id);
        } else if (arrayWebsiteTypes.includes(type)) {
            return await pkg.datatable_array_website(page, type, id);
        } else if (privilageTypes.includes(type)) {
            return await PrivilageFunc[type](page, type, id);
        } else if (datatableTypes.includes(type)) {
            return await pkg.datatable(page, type, id);
        } else if (syncTypes.includes(type)) {
            return await pkg.sync(page, type, id);
        } else if (searchTypes.includes(type)) {
            return await pkg.search_load(page, type, id);
        } else if (habitTypes.includes(type)) {
            return await HabitsApp[type](page, type, id);
        } else if (ecommerceTypes.includes(type)) {
            console.log(await EcommerceApp[type](page, type, id));
            return;
        } else if (erpTypes.includes(type)) {
            console.log(await ErpPosApp[type](page, type, id));
            return;
        } else if (chatTypes.includes(type)) {
            return await pkg.chat(page, type, id);
        }

    }

}