export default class UrlFecth {
    async fetchDataFromApi(apiEndpoint, method = 'GET', data = null) {
            try {
                const options = {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                };

                if (method === 'GET' && data) {
                   
                    const params = new URLSearchParams(data).toString();
                    apiEndpoint += (apiEndpoint.includes('?') ? '&' : '?') + params;
                } else if (data && method !== 'HEAD') {
                    
                    options.body = JSON.stringify(data);
                }
                const response = await fetch(apiEndpoint, options);
                if (!response.ok) throw new Error('Network response was not ok');

                return await response.json();
            } catch (error) {
                console.error('Error fetching data from API:', error);
                throw error;
            }
        }
		async isOnline() {
            return navigator.onLine;
        }
}