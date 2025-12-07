import FaiModule from './FaiModule.js';

import * as LoginHub from './Hub/LoginHub.js';

export default class FaiFramework extends FaiModule {
  constructor() { 
	super();
    
    
	
	this.template = ""; 
	this.domain = "";
	this.version = "";
	this.base_url = "";
	this.base_url_non_index = "";
	this.base_url_object = "";
	this.versionContent = {};
	this.domainDetail = {};
  }

  async init(containerId,domain,version=null,base_url="",base_url_non_index ="",base_url_object="",domainDetail=null,template=null) {
    this.containerId = containerId;
    this.domain = domain;
    this.version = version;
	this.base_url = base_url;
	this.base_url_non_index = base_url_non_index;
	this.base_url_object = base_url_object;
	if(!domainDetail){
		this.domainDetail = await this.getDomainDetail(this.domain);;
	}else{
		this.domainDetail = domainDetail;
	}
	console.log(this.domainDetail);
	if(!template){
		 this.template = await this.domainDetail.template_utama;
	}else{
		 this.template = template;
	}
	
  }
  async setupFullWebContent(){
	  await this.setupContent();
	  await this.setupModule();
	  await this.initializePage();
	  await this.initializeApp();
	  await this.processPages();
  }
  async setupContent(){
	this.versionContent = await this.getVersionControl(this.version) ;  
	this.versionContent['load']={domain: this.domain};
	this.versionContent.web = this.domainDetail;
	console.log(this.versionContent);
  } 
 
  async setupModule(){
	  
	this.ContentProcessing.setVersion(this.versionContent);
	this.ContentProcessing.setVersion(this.versionContent);
	this.ContentProcessing.setModule("linkModule",this.linkModule);
	this.ContentProcessing.setModule("CoreDatabase",this.CoreDatabase);
	this.ContentProcessing.setModule("base_url",this.base_url);
	this.ContentProcessing.setModule("base_url_non_index",this.base_url_non_index);
	this.CoreDatabase.setModule("base_url",this.base_url);
	this.CoreDatabase.setModule("base_url_non_index",this.base_url_non_index);
	this.CoreDatabase.setModule("deviceModule",this.deviceModule);
    this.CorePages.setModule("linkModule",this.linkModule); 
    this.CorePages.setModule("loaderModule",this.loaderModule); 
    this.CorePages.setModule("base_url",this.base_url); 
    this.CorePages.setModule("versionContent",this.versionContent); 
    this.CorePages.setModule("loader",this.loaderModule); 
    this.CorePages.setModule("CoreDatabase",this.CoreDatabase); 
  }
 
  async checkTemplateLogin(){} 
 
  async initializePage(){
	let content = await this.loadContentTemplate("fai","fai_first_template");
	document.getElementById(this.containerId).innerHTML = content.content.css+content.content.html+content.content.js;;  
  }
  async initializeApp(){
	await this.checkTemplateLogin();
	console.log("initializeApp",this.template);
	const array = [{
		0: this.template,
        1: "base",
        return: "html_content"
    }];
	const result = await this.getModule("ContentProcessing").executeContentLogic(array, 0, {});
	await this.setInitilizeApp(result);
  } 
  async setInitilizeApp(result){
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
	
                await this.login.checkLoginStatus().then((isLoggedIn) => {
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
				const data_link = await this.linkModule.getLastPathSegment(currentUrl,this.base_url);
				alert(data_link);
				if(!data_link){
					const home = await this.linkModule.encodeDataForHref(["home"]);
						window.history.pushState({}, '',  this.base_url_object+'/app/'+home);
				}
                
  } 
  async processPages(){
	   await this.CorePages.processPages();
  } 
  async getDomainDetail(domain){
	   
	   let apiEndpoint = this.base_url + "api/main_web/"; 
	   let dataApi = await this.getModule("urlHelper").fetchDataFromApi(apiEndpoint, 'GET',  null);
	   console.log(domain);
	   return dataApi[domain];
  }
  async getVersionControl(version_name){
	const dbName = 'FaiBe3DB';
	const dbVersion = Date.now();
    const storeName = 'mainStore'; 
	const apiEndpoint = this.base_url + "version/content?version="+version_name; 
	const result = await this.getModule("indexedDb").getDataByKeyAndUpdateIfNotFound(dbName, dbVersion, storeName, version_name, apiEndpoint);
	
	const return_data = {
                    data: (result.main_page),
                    menu: (result.main_menu),
                    app: (result.main_app),
                    menu_list: (result.menu_list),
                };
	return return_data;
  }
  async loadContentTemplate(func,type){
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
    const templateUrl = this.base_url_non_index + "FaiFramework/Pages/_template/";
            // console.log("all_result_get before3(awal render)", all_result_get);


            // Replace placeholders in templateString
    for (const type of ['css', 'html', 'js']) {
        content.content[type] = content.content[type]?.replace(patternbe3template, templateUrl)
		.replace(tagNamebe3Framewowk, templateUrl)
			.replace(/{HTTPS}/gi, "https")
            .replace(new RegExp(this.base_url + "FaiFramework/Pages/_template/", 'gi'), templateUrl) || "";
    }
	return content;
  } 
  async Apps(_controller,_function){
	  
  }
  async VersionControlPage(){
	  
  }
  async crudApps(_controller,_function){
	crudSet = Apps(_controller,_function)['crud'];
	return crud(crudSet);
  }
  async crud(crudSet,crudConfig=[]){
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
	 return  this.crudModule.init();
  } 
  async List(crudArray){
	  
  }
  async viewLayoutApp(_controller,_function){
	  
  }
  
  async viewLayout(_controller,_function){
	  
  }
  async orderSystem(){
	  
  }
  async register(){
	  
  }
  async login(){
	  
  } 
  async profil(){
	  
  }
  async workspace(){
	  
  }
  async produk(){
	  
  }
  
}
window.loginHub = LoginHub;

// ✅ 2. (Opsional) Sebar semua ke global scope langsung
Object.entries(LoginHub).forEach(([key, value]) => {
  window[key] = value;
});