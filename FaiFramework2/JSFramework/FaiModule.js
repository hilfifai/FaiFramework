export default class FaiModule {
	constructor() {
		this.deps = {};
		this.initialized = false;
	}

	async initModule() {
		// Load semua modul di sini (modular dan aman dari circular ref)
		const [
			{ default: CrudBuilder },
			{ default: FormBuilder },
			{ default: LoaderBuilder },
			{ default: LoginBuilder },
			{ default: OrderSystemBuilder },
			{ default: IndexedDb },
			{ default: Login },
			{ default: Device },
			{ default: Link },
			{ default: UrlFecth },
			{ default: ContentProcessing,ContentRenderer },
			{ default: CoreDatabase },
			{ default: CorePages },
			{ default: ViewLayoutProcessing },
			{ default: ViewWebsiteProcessing },
			{ default: PartialProcessing },
			{ default: DataProcessing },
			{ default: BundleProcessing },
			{ default: SearchProcessing },
			{ default: ListDataHub },
			{ default: LoginHub },
		] = await Promise.all([
			import('./Builder/CrudBuilder.js'),
			import('./Builder/FormBuilder.js'),
			import('./Builder/LoaderBuilder.js'),
			import('./Builder/LoginBuilder.js'),
			import('./Builder/OrderSystemBuilder.js'),
			import('./Database/IndexedDb.js'),
			import('./Helper/Login.js'),
			import('./Helper/Device.js'),
			import('./Helper/Link.js'),
			import('./Helper/UrlFecth.js'),
			import('./Processing/ContentProcessing.js'),
			import('./Core/CoreDatabase.js'),
			import('./Core/CorePages.js'),
			import('./Processing/ViewLayoutProcessing.js'),
			import('./Processing/ViewWebsiteProcessing.js'),
			import('./Processing/PartialProcessing.js'),
			import('./Processing/DataProcessing.js'),
			import('./Processing/BundleProcessing.js'),
			import('./Processing/SearchProcessing.js'),
			import('./Hub/ListDataHub.js'),
			import('./Hub/LoginHub.js'),
			
		]);

		// Optional: dynamic Hub import
		

		// Buat instance
		this.deps = {
			loginHelper: new Login(),
			ViewLayout: new ViewLayoutProcessing(),
			ViewWebsite: new ViewWebsiteProcessing(),
			Partial: new PartialProcessing(),
			Bundle: new BundleProcessing(),
			ContentProcessing: new ContentProcessing(),
			SearchProcessing: new SearchProcessing(),
			Data: new DataProcessing(),
			ContentRenderer: new ContentRenderer(),
			CoreDatabase: new CoreDatabase(),
			CorePages: new CorePages(),
			loaderBuilder: new LoaderBuilder(),
			formBuilder: new FormBuilder(),
			crudBuilder: new CrudBuilder(),
			loginBuilder: new LoginBuilder(),
			OrderSystemBuilder: new OrderSystemBuilder(),
			urlHelper: new UrlFecth(),
			linkHelper: new Link(),
			indexedDb: new IndexedDb(),
			deviceHelper: new Device(),
			ListDataHub: new ListDataHub(),
			loginHub: new LoginHub() 
		}; 

		// Inject semua deps
		for (const key in this.deps) {
			const instance = this.deps[key];
			if (typeof instance?.setDependencies === 'function') {
				instance.setDependencies(this.deps);
			}
		}
		for (const key in this.deps) {
			this.deps[key].setDependencies?.(this.deps);
		}
		this.initialized = true;
	}

	async setDependencies(deps) {
		this.deps = deps;
	}
	async setModule(key, value) {
		this.deps[key] = value;

		// Auto inject ke class kalau ada method setDependencies
		if (typeof value === 'object' && typeof value.setDependencies === 'function') {
			value.setDependencies(this.deps);
		}
	}
	 getModule(name) { 
		return this.deps?.[name];
	}
}
