export default class Link {
	async getLink() {
		const currentUrl = window.location.href;
		const data_link = await this.getLastPathSegment(currentUrl, window.fai.getModule("base_url"));
		let section = "home";
		let page;
		let id;
		let parts;
		let viewpage;
		if (data_link != 'app2') {

			viewpage = await this.decodeDataFromHref(data_link);
			parts = viewpage;
			console.log("viewpage", viewpage);
			section = await this.replace_stript(viewpage[0]) || "home";
			page = await this.replace_stript(viewpage[1]) || "home";
			id = await this.replace_stript(viewpage[2]) || null;
		} else {

			viewpage = {};
		}
		return {
			section: section,
			page: page,
			id: id,
			parts: parts,
		}
	}
	async encodeDataForHref(obj) {
		const json = JSON.stringify(obj);
		const utf8 = encodeURIComponent(json);
		return btoa(utf8)
			.replace(/\+/g, '-') // Ganti + dengan -
			.replace(/\//g, '_') // Ganti / dengan _
			.replace(/=+$/, ''); // Hapus padding =
	}

	async decodeDataFromHref(encoded) {
		console.log("encoded", encoded);
		const base64 = encoded
			.replace(/-/g, '+')
			.replace(/_/g, '/');
		const json = decodeURIComponent(atob(base64));
		return JSON.parse(json);
	}
	async getLastPathSegment(url, base_url) {
		try {
			url = url.replace('/index.php/FaiServer/app2', "");
			let parsed = new URL(url);
			const pathParts = parsed.pathname.split('/').filter(part => part.trim() !== '');
			return pathParts.length > 0 ? pathParts[pathParts.length - 1] : '';
		} catch {
			// Jika URL tidak valid, coba split biasa
			const parts = url.split('/').filter(part => part.trim() !== '');
			return parts.length > 0 ? parts[parts.length - 1] : '';
		}
	}
	async replace_stript(string) {
		if (string)
			return string.replace(/-/g, "_");
		else
			return string;
	}
}