import FaiModule from './FaiModule.js';

import LoginHub from './Hub/LoginHub.js';
import * as EcommerceHub from './Hub/EcommerceHub.js';
import ListDataHub from './Hub/ListDataHub.js';
import * as GeneralHub from './Hub/GeneralHub.js';
import { setShowAlert } from './Helper/Notification.js';
import SelectSearch from './Helper/SelectSearch.js';
export class FaiFramework extends FaiModule {
	constructor() {
		super();

		this.template = "";
		this.originalTemplate = "";
		this.domain = "";
		this.version = "";
		this.base_url = "";
		this.base_url_non_index = "";
		this.base_url_object = "";
		this.versionContent = {};
		this.domainDetail = {};
		this.after_init = {};
	}
 
	async init(containerId, option,domain, version = null, base_url = "", base_url_non_index = "", base_url_object = "", domainDetail = null, template = null) {
		await this.initModule();
		this.containerId = containerId;
		this.option = option;
		
		this.domain = domain;
		this.version = version;
		this.base_url = base_url;
		this.base_url_non_index = base_url_non_index;
		this.base_url_object = base_url_object;
		await this.setModule("domain", this.domain);
		await this.setModule("base_url", this.base_url);
		await this.setModule("base_url_non_index", this.base_url_non_index);
		await this.setModule("base_url_object", this.base_url_object);
		if (!domainDetail) {
			this.domainDetail = await this.getDomainDetail(this.domain);;
		} else {
			this.domainDetail = domainDetail;
		}
		if (!template) {
			this.template = await this.domainDetail.template_utama;
			this.originalTemplate = await this.domainDetail.template_utama;

		} else {
			this.template = template;
		}
		
		await this.setModule("template", this.template);
		await this.setModule("originalTemplate", this.originalTemplate);
		await this.setModule("domainDetail", this.domainDetail);

	}
	async setupFullWebContent() {
		await this.setupContent();
		await this.setupModule();
		await this.initializeLogin();
		await this.initializePage();
		await this.initializeApp();
		await this.setMetaWeb();
		await this.processPages();
		await this.setSearch();
		await this.optionTriggrer();

	}
	async setMetaWeb() {
		document.getElementById("template").innerHTML = this.template;
		document.getElementById("base_template").innerHTML = this.template;
		document.title = this.domainDetail.meta_title;
		document.querySelector('meta[name="description"]').setAttribute("content", this.domainDetail.meta_description);
		let metaKeywords = document.querySelector('meta[name="keywords"]');
		if (!metaKeywords) {
			metaKeywords = document.createElement('meta');
			metaKeywords.name = "keywords";
			document.head.appendChild(metaKeywords);
		}
		metaKeywords.content = this.domainDetail.meta_keyword;

	}
	async setupContent() {
		this.versionContent = await this.getVersionControl(this.version);
		this.versionContent['load'] = { domain: this.domain };
		let GetLink = await this.getModule('linkHelper').getLink();
		const load_page_id = GetLink.id;
		if (!this.versionContent.view) {
			this.versionContent.view = {};
		}
		if (!this.versionContent.view.load) {
			this.versionContent.view.load = {};
		}
		this.versionContent.view['load'] = { load_page_id: load_page_id };
		this.versionContent.web = this.domainDetail;
	}

	async setupModule() {
		console.log("this.versionContent",this.versionContent);

		await this.setModule("versionContent", this.versionContent);
		await this.setModule("template", this.template);
		await this.setModule("domain", this.domain);
		await this.setModule("version", this.version);
		await this.setModule("domainDetail", this.domainDetail);
		await this.setModule("after_init", this.after_init);
		await this.setModule("data_produk", []);
		await this.setModule("data_produk_real", []);
		await this.setModule("data_produk_array", []);
		await this.setModule("data_produk_itemsPerPage", []);
		await this.setModule("data_produk_content", []);
		await this.setModule("data_produk_search_field", []);
		await this.setModule("data_produk_after_init", []);

	}

	async checkTemplateLogin() {
		let get = await this.getModule('loginHelper').checkLoginStatus();
		console.log("checkTemplateLogin", get);
		if (get.template) {
			await this.setModule("template", get.template);
			this.template = get.template;
		}
		if (get.id_first_menu) {
			this.domainDetail.id_first_menu = get.id_first_menu;
			this.domainDetail.original_id_first_menu = get.id_first_menu;
			await this.setModule("domainDetail", this.domainDetail);
			this.versionContent.web = this.domainDetail;
		}
	}
	async initializeLogin() {
		this.getModule('loginBuilder').show
			({
				container: document.getElementById('login-builder-container'),
				displayMode: 'modal', // Change to 'full-page' for full page view
				elements: ['login', 'register'],
				isCanAsGuest: true,
				isCanAsSSO: true,
				isDefaultLogin: false,
				verificationMethod: 'sms' // or 'email'
			});


	}

	async initializePage() {
		let content = await this.loadContentTemplate("fai", "fai_first_template");
		document.getElementById(this.containerId).innerHTML = content.content.css + content.content.html + content.content.js;;
	}
	async initializeApp() {
		await this.checkTemplateLogin();
		console.log("initializeApp", this.template);
		const array = [{
			0: this.template,
			1: "base",
			return: "html_content"
		}];
		const result = await this.getModule("ContentProcessing").executeContentLogic(array, 0, {});
		await this.setInitilizeApp(result);
		console.log("SELESAI INITIALIZE");
	}
	async setInitilizeApp(result) {
		// console.log("result", result.css);
		// console.log("html", result.html);
		document.getElementById('styling').innerHTML = (result.css);
		document.getElementById('app').innerHTML = (result.html);
		// document.getElementById('jsscript').innerHTML = eval(result.js);
		const container = document.createElement('div');
		container.innerHTML = result.js;
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

		await this.getModule("loginHelper").checkLoginStatus().then((isLoggedIn) => {
			if (isLoggedIn) {
				document.querySelectorAll('.is_login').forEach(el => {
					el.style.display = 'block';
				});
				document.querySelectorAll('.not_login').forEach(el => {
					el.style.display = 'none';
				});
			} else {
				document.querySelectorAll('.is_login').forEach(el => {
					el.style.display = 'none';
				});
				document.querySelectorAll('.not_login').forEach(el => {
					el.style.display = 'block';
				});
				console.log("User belum login");
			}

		});

		const currentUrl = window.location.href;
		const data_link = await this.getModule("linkHelper").getLastPathSegment(currentUrl, this.getModule("base_url"));

		if (!data_link) {
			const home = await this.getModule("linkHelper").encodeDataForHref(["home"]);
			window.history.pushState({}, '', '/app2/' + home);
		}


	}
	async processPages() {
		await this.getModule("CorePages").processPages();
	}
	async setSearch() {
		await this.getModule("SearchProcessing").initSearch();
	}
	async optionTriggrer(){
			await this.getModule("optionTriggrer").init(this.option);
	}
	async getDomainDetail(domain) {

		let apiEndpoint = await this.getModule("base_url") + "api/main_web/";
		let dataApi = await this.getModule("urlHelper").fetchDataFromApi(apiEndpoint, 'GET', null);
		
		return dataApi[domain];
	}
	async getVersionControl(version_name) {
		const dbName = 'FaiBe3DB';
		const dbVersion = Date.now();
		const storeName = 'mainStore';

		const apiEndpoint = this.getModule("base_url") + "version/content?version=" + version_name;
		//const result = await this.getModule("indexedDb").getDataByKeyAndUpdateIfNotFound(dbName, dbVersion, storeName, version_name, apiEndpoint);
		let result = await this.getModule("urlHelper").fetchDataFromApi(apiEndpoint, 'GET', null);
		console.log(result);
		const return_data = {
			data: (result.main_page),
			menu: (result.main_menu),
			app: (result.main_app),
			menu_list: (result.menu_list),
			main_search: (result.main_search),
		};
		return return_data;
	}
	async loadContentTemplate(func, type) {
		console.log('func', func);
		console.log('type', type);
		let last_version = this.versionContent.data.versions[func].last_version;
		let content;
		if (this.versionContent.data.versions[func].versions[last_version][type]) {
			content = await this.versionContent.data.versions[func].versions[last_version][type];
		} else {
			content.content.html = '';
		}
		const tagNamebe3FramewowkTemp = "BE3-URL-FRAMEWORK";
		const tagNamebe3Framewowk = new RegExp(`<${tagNamebe3FramewowkTemp}></${tagNamebe3FramewowkTemp}>`, 'gi');
		const tagNamebe3temp = "BE3-LINK-TEMPLATE";
		const patternbe3template = new RegExp(`<${tagNamebe3temp}></${tagNamebe3temp}>`, 'gi');
		const templateUrl = this.getModule("base_url_non_index") + "FaiFramework/Pages/_template/";
		// console.log("all_result_get before3(awal render)", all_result_get);


		// Replace placeholders in templateString
		for (const type of ['css', 'html', 'js']) {
			content.content[type] = content.content[type]?.replace(patternbe3template, templateUrl)
				.replace(tagNamebe3Framewowk, templateUrl)
				.replace(/{HTTPS}/gi, "https")
				.replace(new RegExp(this.getModule("base_url") + "FaiFramework/Pages/_template/", 'gi'), templateUrl) || "";
		}
		return content;
	}
	async Apps(_controller, _function) {

	}
	async VersionControlPage() {

	}
	async crudApps(_controller, _function) {
		crudSet = Apps(_controller, _function)['crud'];
		return crud(crudSet);
	}
	async crud(crudSet, crudConfig = []) {
		const tableConfig = {
			containerId: 'my-table-container',
			modalId: 'form-modal',
			fieldConfigs: crudSet['array'],
			crudSet: crudSet,
			apiUrl: "", // Ganti dengan URL API Anda
			backendUrl: "{{ env('GOLANG_API_KEY') }}",
			api_token: "{{ session('api_token') }}"
		};
		await this.crudModule.CrudConfig(tableConfig);
		return this.crudModule.init();
	}
	async List(crudArray) {

	}
	async viewLayoutApp(_controller, _function) {

	}

	async viewLayout(_controller, _function) {

	}
	async orderSystem() {

	}
	async register() {

	}
	async login() {

	}
	async profil() {

	}
	async workspace() {

	}
	async produk() {

	}
initSelectSearch(elementId, options = {}) {
        try {
            // Dapatkan SelectSearch manager dari module
            const selectSearch = this.getModule('SelectSearch');
            
            if (!selectSearch || typeof selectSearch.init !== 'function') {
                console.error('SelectSearch module tidak ditemukan atau tidak valid');
                return null;
            }
            
            // Gunakan method init dari object manager
            return selectSearch.init(elementId, options);
        } catch (error) {
            console.error('Error initializing SelectSearch:', error);
            return null;
        }
    }

    // Auto init untuk SelectSearch berdasarkan data attributes
    autoInitSelectSearch() {
        // Tunggu sedikit untuk memastikan DOM siap
        setTimeout(() => {
            const selectSearch = this.getModule('SelectSearch');
            if (selectSearch && typeof selectSearch.autoInit === 'function') {
                selectSearch.autoInit();
            }
        }, 100);
    }

    // Helper untuk penggunaan cepat
    selectSearch(elementId, options) {
        return this.initSelectSearch(elementId, options);
    }
}
window.GeneralHub = GeneralHub;

Object.entries(GeneralHub).forEach(([key, value]) => {
	window[key] = value;
});
window.loginHub = LoginHub;

Object.entries(LoginHub).forEach(([key, value]) => {
	window[key] = value;
});

window.EcommerceHub = EcommerceHub;
Object.entries(EcommerceHub).forEach(([key, value]) => {
	window[key] = value;
});
const listDataHub = new ListDataHub();

// Inject semua method class ke window
Object.getOwnPropertyNames(Object.getPrototypeOf(listDataHub))
	.filter(prop => prop !== 'constructor' && typeof listDataHub[prop] === 'function')
	.forEach(method => {
		window[method] = listDataHub[method].bind(listDataHub);
	});

const loginHub = new LoginHub();

// Inject semua method class ke window
Object.getOwnPropertyNames(Object.getPrototypeOf(loginHub))
	.filter(prop => prop !== 'constructor' && typeof loginHub[prop] === 'function')
	.forEach(method => {
		window[method] = loginHub[method].bind(loginHub);
	});

// Optional: Bisa juga expose class-nya kalau butuh
window.loginHub = loginHub;
window.fai = this;
window.setShowAlert = setShowAlert;
window.SelectSearch = SelectSearch;