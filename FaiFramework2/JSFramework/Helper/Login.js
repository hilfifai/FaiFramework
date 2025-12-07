
export default class Login {
	async checkLoginStatus() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open("myAppDB", 1);

                request.onerror = () => reject("Database gagal dibuka");
                request.onsuccess = () => {
                    const db = request.result;
                    const tx = db.transaction("session", "readonly");
                    const store = tx.objectStore("session");
                    const getRequest = store.get("current");
                    getRequest.onsuccess = () => {
                        const session = getRequest.result;
                        console.log("LOGIN", session);
                        if (session && session.isLoggedIn) {
                            resolve(session); // Sudah login
                        } else {
                            resolve(false); // Belum login
                        }
                    };

                    getRequest.onerror = () => reject("Gagal membaca data session");
                };

                request.onupgradeneeded = (event) => {
                    const db = event.target.result;
                    if (!db.objectStoreNames.contains("session")) {
                        db.createObjectStore("session", {
                            keyPath: "id"
                        });
                    }
                };
            });
        }
		
}