import FaiModule from '../FaiModule.js';

export default class IndexedDb extends FaiModule {
    
    constructor() {
        super();
        this.dbPromises = new Map(); // Cache database connections
    }

    async openDatabase(dbName, dbVersion, storeName) {
        // Create a unique key for this database configuration
        // const dbKey = `${dbName}_${dbVersion}_${Array.isArray(storeName) ? storeName.join(',') : storeName}`;
        
        // // Return cached promise if available
        // if (this.dbPromises.has(dbKey)) {
        //     return this.dbPromises.get(dbKey);
        // }

        // const dbPromise = new Promise((resolve, reject) => {
        //     console.log(`Opening DB: ${dbName}, Version: ${dbVersion}, Store: ${storeName}`);
            
        //     const request = indexedDB.open(dbName, dbVersion);
            
        //     request.onerror = (event) => {
        //         console.error('DB open error:', event.target.error);
        //         this.dbPromises.delete(dbKey);
        //         reject(event.target.error);
        //     };
            
        //     request.onsuccess = (event) => {
        //         const db = event.target.result;
        //         console.log('DB opened successfully');
        //         console.log('Available stores:', Array.from(db.objectStoreNames));
        //         resolve(db);
        //     };
            
        //     request.onupgradeneeded = (event) => {
        //         const db = event.target.result;
        //         const oldVersion = event.oldVersion;
        //         const newVersion = event.newVersion;
                
        //         console.log(`DB upgrade needed. Version: ${oldVersion} -> ${newVersion}`);
        //         console.log('Current stores:', Array.from(db.objectStoreNames));
                
        //         const stores = Array.isArray(storeName) ? storeName : [storeName];
                
        //         stores.forEach(store => {
        //             if (!db.objectStoreNames.contains(store)) {
        //                 console.log(`Creating store: ${store}`);
        //                 db.createObjectStore(store, { keyPath: "id" });
        //             }
        //         });
                
        //         console.log('After upgrade - stores:', Array.from(db.objectStoreNames));
        //     };
        // });

        // // Cache the promise
        // this.dbPromises.set(dbKey, dbPromise);
        // return dbPromise;
    }

    async getDataByKeyAndUpdateIfNotFound(dbName, dbVersion, storeName, key, endpoint) {
        // try {
            // Ensure database and store are properly created
        //     const db = await this.openDatabase(dbName, dbVersion, storeName);
            
        //     // Double-check store exists with a small delay to ensure upgrade completed
        //     await new Promise(resolve => setTimeout(resolve, 10));
            
        //     // Verify store exists - if not, we need to force a new connection
        //     if (!db.objectStoreNames.contains(storeName)) {
        //         console.warn(`Store ${storeName} not found, forcing database recreation`);
        //         // Close current connection and clear cache
        //         db.close();
        //         const dbKey = `${dbName}_${dbVersion}_${Array.isArray(storeName) ? storeName.join(',') : storeName}`;
        //         this.dbPromises.delete(dbKey);
                
        //         // Try again with a higher version to force upgrade
        //         const newDb = await this.openDatabase(dbName, dbVersion + 1, storeName);
        //         return await this.getDataByKeyAndUpdateIfNotFound(dbName, dbVersion + 1, storeName, key, endpoint);
        //     }
            
        //     // Get data from store
        //     const transaction = db.transaction([storeName], 'readonly');
        //     const store = transaction.objectStore(storeName);
        //     const request = store.get(key);
            
        //     const result = await new Promise((resolve, reject) => {
        //         request.onsuccess = () => resolve(request.result);
        //         request.onerror = (event) => reject(event.target.error);
        //     });
            
        //     const isOnline = this.getModule("urlHelper").isOnline();
            
        //     if (!isOnline) {
        //         return result ? result.data : null;
        //     }
            
        //     if (!result) {
        //         const apiData = await this.getModule("urlHelper").fetchDataFromApi(endpoint);
        //         await this.saveDataToIndexedDB(dbName, dbVersion, storeName, key, apiData);
        //         return apiData;
        //     }
            
        //     return result.data;
            
        // } catch (error) {
        //     console.error('Error getting or saving data:', error);
        //     throw error;
        // }
    }

    async saveDataToIndexedDB(dbName, dbVersion, storeName, key, data) {
        const db = await this.openDatabase(dbName, dbVersion, storeName);
        
        // Verify store exists before transaction
        if (!db.objectStoreNames.contains(storeName)) {
            throw new Error(`Store ${storeName} does not exist in database ${dbName}`);
        }
        
        const transaction = db.transaction([storeName], 'readwrite');
        const store = transaction.objectStore(storeName);
        
        const item = {
            id: key,
            data: data,
            timestamp: Date.now()
        };
        
        const request = store.put(item);
        
        return new Promise((resolve, reject) => {
            request.onsuccess = () => resolve();
            request.onerror = (event) => reject(event.target.error);
        });
    }  
    async storeExists(dbName, dbVersion, storeName) {
        try {
            const db = await this.openDatabase(dbName, dbVersion, storeName);
            return db.objectStoreNames.contains(storeName);
        } catch (error) {
            console.error('Error checking store existence:', error);
            return false;
        }
    }
} 