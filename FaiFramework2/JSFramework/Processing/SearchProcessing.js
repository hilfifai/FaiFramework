import FaiModule from '../FaiModule.js';
export default class ContentProcessing extends FaiModule {
    constructor() {
        super();
    }
    initSearch() {

        let router_search = ("versionContent", this.getModule("versionContent").main_search.versions.router)
            ;
        let last_version = router_search.last_version;
        let searchContent = router_search.versions[last_version][this.getModule("domain")];
        this.initSearchListeners(searchContent)
    }
    async initSearchListeners(searchContent) {
        const formId = searchContent.form_id;
        const params = searchContent.get_params;

        const form = document.getElementById(formId);
        if (!form) {
            console.error("Form tidak ditemukan:", formId);
            return;
        }
        const areAllParamsEmpty = () => {
            return Object.keys(params).every((field) => {
                const el = form.querySelector(`[name="${field}"]`);
                return el && el.value.trim() === "";
            });
        };

        const toggleDefaultPage = () => {
            if (areAllParamsEmpty()) {
                document.getElementById('pages_content').style.display = "block";
                document.getElementById('search_result_content').style.display = "none";
                return true;
            }
            return false;
        };

        Object.entries(params).forEach(([fieldName, config]) => {
            const element = form.querySelector(`[name="${fieldName}"]`);

            if (!element) {
                console.warn(`Element name='${fieldName}' tidak ditemukan`);
                return;
            }

            if (config.type === "input") {
                element.addEventListener(
                    "keyup",
                    this.debounce(async (e) => {    // ← tambahkan async
                        const value = e.target.value.trim();
                        if (toggleDefaultPage()) return;
                        // minimal karakter
                        if (config.min_input && value.length < config.min_input) return;

                        await this.sendSearchRequest(searchContent, form, params);
                    }, 1000)
                );
            }

            if (config.type === "select") {
                element.addEventListener("change", async () => {   // ← async di sini
                    if (toggleDefaultPage()) return;
                    await this.sendSearchRequest(searchContent, form, params);
                });
            }
        });
    }


    async sendSearchRequest(searchContent, form, params) {
        const query = {};
        let isSearch = false;
        Object.keys(params).forEach((field) => {
            const el = form.querySelector(`[name="${field}"]`);
            if (el) query[field] = el.value;
            if (el.value) {
                isSearch = true;
            }
        });
        query['domain'] = this.getModule("domain");
        console.log("Sending to API:", query);

        // fetch("/api/search?" + new URLSearchParams(query))
        //     .then(res => res.json())
        //     .then(data => {
        //         console.log("API Response:", data);
        //         await this.renderSearchResult(searchContent, data);
        //     })
        //     .catch(err => console.error(err));
        if (isSearch) {
            document.getElementById('pages_content').style.display = "none";
            document.getElementById('search_result_content').style.display = "block";
            await this.getModule("loaderBuilder").spinner('search_result_content');
            try {
                // const res = await fetch("/api/search?" + new URLSearchParams(query));
                // const data = await res.json();

                // console.log("API Response:", data);
                let data = {};
                data['Judul'] = [];
                await this.renderSearchResult(searchContent, data, query);

            } catch (err) {
                console.error(err);
            }
        } else {
            document.getElementById('pages_content').style.display = "block";
            document.getElementById('search_result_content').style.display = "none";
        }
    }
    async renderSearchResult(searchContent, data, query) {
        await this.setModule("searchData", query)
        document.getElementById('search_result_content').innerHTML = "";
        let search_result_content = "";
        for (const content of searchContent.content) {
            search_result_content += `<h3>${content.Judul}</h3>`;
            const array = [{
                0: content.view[0],
                1: content.view[1],
                return: "html_content"
            }];
            const result = await this.getModule("ContentProcessing").executeContentLogic(array, 0, {}, data[content.Judul], content.array);
            console.log(result);
            search_result_content += result.html;
        };

        console.log("search_result_content", search_result_content);
        document.getElementById('search_result_content').innerHTML = search_result_content;


        await this.getModule("CorePages").proses_after_init();
        document.getElementById("search-data_search").value = query.keyword;
        document.getElementById("search-data_search").dispatchEvent(new Event("input"));
        document.getElementById("search-data_search").dispatchEvent(new Event("change"));
        document.getElementById("search-data_search").dispatchEvent(new KeyboardEvent("keyup", { key: query.keyword }));
    }
    debounce(fn, delay) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), delay);
        };
    }
}