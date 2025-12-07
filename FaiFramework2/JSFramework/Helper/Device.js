export default class Device {
	
        async  getDeviceId() {
			return (await (await FingerprintJS.load()).get()).visitorId;
		}
        async  visitorId() {
            const deviceId = await getDeviceId();
            return deviceId;
        }
        async getStableDeviceId () {
            const localKey = 'myDeviceId';
            let deviceId = localStorage.getItem(localKey);
            if (!deviceId) {
                const fp = await FingerprintJS.load();
                const result = await fp.get();
                deviceId = result.visitorId;
                localStorage.setItem(localKey, deviceId);
            }
            return deviceId;
        }
}