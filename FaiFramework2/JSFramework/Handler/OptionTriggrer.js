import FaiModule from '../FaiModule.js';
export default class OptionTriggrer extends FaiModule {
    constructor() {
        super();
    }
    async init(option) {
        this.option = option;
        if (option?.pending_order) {
            await this.pending_order();
        }
    }
    async pending_order() {
        let apiEndpoint = await this.getModule("base_url") + "api/get_pending_order/";
        let pendingOrder = await this.getModule("urlHelper").fetchDataFromApi(apiEndpoint, 'GET', null);
        console.log("pending_order", pendingOrder);
        if (pendingOrder.num_rows) {
            let optionsHTML = '<select id="orderSelect" style="width:100%; padding:10px; margin:15px 0; border:1px solid #ddd; border-radius:5px;">';
            if (pendingOrder.num_rows > 1)
                optionsHTML += '<option value="">-- Pilih Order --</option>';

            pendingOrder.row.forEach((order, index) => {
                optionsHTML += `<option value="${order.id}">${order.nomor} - ${order.tipe_group}</option>`;
            });

            optionsHTML += '</select>';
            Swal.fire({
                title: `Kamu memiliki ${pendingOrder.num_rows} Order tertahan`,
                html: optionsHTML,
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan Pesanan',
                cancelButtonText: 'Batalkan Pesanan',
                focusConfirm: false,
                preConfirm: () => {
                    const selectedId = document.getElementById('orderSelect').value;
                    if (!selectedId) {
                        Swal.showValidationMessage('Silakan pilih order terlebih dahulu');
                        return false;
                    }
                    return selectedId;
                }
            }).then(async (result) => {
                if (result.isConfirmed && result.value) {
                    const selectedOrderId = result.value;
                    const selectedOrder = pendingOrder.row.find(order => order.id === selectedOrderId);

                    if (selectedOrder) {
                        // Redirect ke halaman yang diinginkan
                        await this.redirectToOrderDetail(selectedOrder);
                    }
                }
            });
        }
    }

    // Fungsi untuk redirect
    async redirectToOrderDetail(order) {
        // Contoh redirect dengan parameter
        const redirectUrl = `/order/detail?id=${order.id}`;
        // atau
        // window.location.href = `/order/detail?id=${order.id}`;

        console.log('Redirect ke:', redirectUrl);
        console.log('Order terpilih:', order);
        const data = [{
            object: 'foreach_1_row'
        }];
        const type = {
            0: "Ecommerce",
            1: "checkout",
            2: "view_layout",
            3: order.id,
        };
        console.log(type);
        const encoded = await btoa(JSON.stringify(type));
        // content.content.html = "javascript:void(link_direct('" + enPage + "','" + encoded + "'))";
        link_direct(encoded);
        // Uncomment untuk redirect sesungguhnya:
        // window.location.href = redirectUrl;

        // Atau jika ingin tampilkan konfirmasi dulu:

    }

}
