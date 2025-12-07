export default class LoaderBuilder {
	async sekeleton(id) {
		let html = '<div id="skeleton-loader"><div class="skeleton-card"><div class="skeleton-item skeleton-avatar"></div><div class="skeleton-details"><div class="skeleton-item skeleton-text"></div>             <div class="skeleton-item skeleton-text skeleton-text-sm"></div>         </div>     </div>     <div class="skeleton-card">         <div class="skeleton-item skeleton-avatar"></div>         <div class="skeleton-details">             <div class="skeleton-item skeleton-text"></div>             <div class="skeleton-item skeleton-text skeleton-text-sm"></div>         </div>     </div>     <div class="skeleton-card">         <div class="skeleton-item skeleton-avatar"></div>         <div class="skeleton-details">             <div class="skeleton-item skeleton-text"></div>             <div class="skeleton-item skeleton-text skeleton-text-sm"></div>         </div>     </div> </div>';
		document.getElementById(id).innerHTML = (html);
		const skeletonLoader = document.getElementById('skeleton-loader');
		const realContent = document.getElementById('real-content-container'); // Anda perlu wrapper untuk konten asli

		if (realContent) realContent.style.display = 'none';
		skeletonLoader.classList.add('visible');

	}
	async spinner(id) {
		let html = '<div id="loader-overlay visible" style="display: flex;justify-content: center;vertical-align: middle;align-content: center;align-items: center;align-self: center;margin-top: 15%;"><div class="loader-spinner visible"></div> </div><br><div style="display: flex;justify-content: center;vertical-align: middle;align-content: center;align-items: center;align-self: center;" >Proses Menyusun Konten, Tunggu Sebentar...</div>';
		document.getElementById(id).innerHTML = (html);


	}
	async progress_bar(id) {
		let html = '<div id="loader-overlay-progress">     <div class="progress-container">         <div class="progress-bar" id="my-progress-bar"></div>         <div class="progress-text" id="my-progress-text">Loading...</div>     </div> </div>';
		document.getElementById(id).innerHTML = (html);


	}
}