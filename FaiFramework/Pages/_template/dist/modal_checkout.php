<style>
#addNewAddress.show{
    display:block !important
}
#addNewAddress{
    display:none;
}
</style><div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Ongkir</h5>
                <button type="button" class="close" onclick="$('#exampleModal').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="kontent_ongkir" style=" overflow-y:scroll;max-height: 400px;">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#exampleModal').modal('hide')">Close</button>
                <button type="button" class="btn btn-primary" onclick="get_change_ongkir($('#load_id').val())">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addNewAddress" tabindex="-1" role="dialog" aria-labelledby="addNewAddress" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAddressLabel">Tambahkan Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="close_modal_address()" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="content_crud">

            </div>
            <div class="modal-footer">
                <input type="hidden" name="nama_pesanan" id="id_pesanan" value="<IDPESANAN></IDPESANAN>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_modal_address()">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_pengiriman_ke()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function close_modal_address(){
        $('#addNewAddress').modal('hide');
        $('.modal-backdrop').removeClass('show');
        $('.modal-backdrop').removeClass('fade');
        $('.modal-backdrop').remove();
        document.body.setAttribute('style', 'overflow: visible;');
    }

    function save_pengiriman_ke() {


        // var form = ; // You need to use standard javascript object here
        var formData = new FormData($('#formvte_fai_framework')[0]);
        formData.append('contentfaiframework', 'get_pages');
        formData.append('MainAll', 2);
        formData.append('not_sidebar', "not");
        formData.append('link_route', $('#load_link_route').val());
        formData.append('apps', $('#load_apps').val());
        formData.append('id', $('#load_id').val());
        formData.append('page_view', $('#load_page_view').val());
        formData.append('menu', $('#load_menu').val());
        formData.append('nav', $('#load_nav').val());
        formData.append('type', "save_pengiriman_ke");
        formData.append('section', '<?= $page['section']; ?>');
        formData.append('array', '<?= isset($page['load']['card']['array']) ? json_encode($page['load']['card']['array']) : -1; ?>');
        formData.append('page_database', '<?= isset($page['load']['page_database']) ? ($page['load']['page_database']) : -1; ?>');
        formData.append('view_layout_number', '<?= isset($page['view_layout_number']) ? ($page['view_layout_number']) : -1; ?>');
        console.log(formData);

        $.ajax({
            type: 'post',
            data: formData,

            url: $('#load_link_route').val(),
            dataType: 'html',

            processData: false,
            contentType: false,
            success: function(data) {
                if(data==1)
                    window.location.href=$('#load_link_route').val();
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });

    }


    function get_change_ongkir(pesanan) {
        var pilih_ongkir = 0;
        if (typeof $('input[name=pilih_ongkir]:checked').val() !== 'undefined') {
            // the variable is defined
            pilih_ongkir = $('input[name=pilih_ongkir]:checked').val();
        }
      
        id_store_tujuan = $('#id_store_tujuan').val();
        kota_asal_changer = $('#kota_asal_changer').val();
        berat_changer = $('#berat_changer').val();
        kota_tujuan_changer = $('#kota_tujuan_changer').val();


        $.ajax({
            type: 'POST',
            data: {
                'link_route' :$('#load_link_route').val() ,
                'apps' :$('#load_apps').val() ,
                'page_view' :$('#load_page_view').val() ,
                'type':'get_change_ongkir' ,
                'id' :$('#load_id').val() ,
                'id_pemesanan' :$('#load_id').val() ,
                'pesanan' :(pesanan) ,
                'pilih_ongkir' :(pilih_ongkir) ,
                'id_store' :(id_store_tujuan) ,
                'id_kota_asal' :(kota_asal_changer) ,
                'id_kota_user' :(kota_tujuan_changer) ,
                'berat' :(berat_changer) ,
                'MainAll':'2' ,
                'contentfaiframework':'get_pages'
            },
            url: $('#load_link_route').val(),
            dataType: 'html',
            success: function(data) {
                $('#ongkir-' + (id_store_tujuan)).html(data);
                print_pesanan();
                $('#exampleModal').modal('hide');
            },
            beforeSend: function(error) {

            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function get_ubah_ongkir(id_store, id_kota_user, berat, id_kota_asal) {
        $.ajax({
            type: 'POST',
            data: $('#formvte_fai_framework').serialize() +
                '&link_route=' + $('#load_link_route').val() +
                '&apps=' + $('#load_apps').val() +
                '&page_view=' + $('#load_page_view').val() +
                '&type=get_all_ongkir' +
                '&id=' + $('#load_id').val() +
                '&id_pemesanan=' + $('#load_id').val() +
                '&id_store=' + (id_store) +
                '&id_kota_asal=' + (id_kota_asal) +
                '&id_kota_user=' + (id_kota_user) +
                '&berat=' + (berat)

                +
                '&MainAll=2' +
                '&contentfaiframework=get_pages',
            url: $('#load_link_route').val(),
            dataType: 'html',
            success: function(data) {
                $('#kontent_ongkir').html(data);
            },
            beforeSend: function(error) {
                $('#kontent_ongkir').html("<center><h2>Loading Data, Tunggu sebentar</h2></center>");
                $('#exampleModal').modal('show');
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function print_pesanan() {
        $.ajax({
            type: 'POST',
            data: $('#formvte_fai_framework').serialize() +
                '&link_route=' + $('#load_link_route').val() +
                '&apps=' + $('#load_apps').val() +
                '&page_view=' + $('#load_page_view').val() +
                '&type=print_pesanan' +
                '&id=' + $('#load_id').val() +
                '&pesanan=' + $('#id_pesananco').val()

                +
                '&MainAll=2' +
                '&contentfaiframework=get_pages',
            url: $('#load_link_route').val(),
            dataType: 'json',
            success: function(data) {
                // $('#detail-order').html(data.summary);
                $('#SUMMARY').html(data.summary);
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }
    get_crud_tambah_bangunan();

    function get_crud_tambah_bangunan() {
        $.ajax({
            type: 'GET',
            data: '&link_route=' + $('#load_link_route').val() +
                '&apps=Inventaris_aset' +
                '&page_view=bangunan2' +
                '&type=tambah' +
                '&not_sidebar=not' +
                '&no_button_vte=not' +
                '&sub_kategori=not' +
                '&id=-1' +

                '&MainAll=2' +
                '&contentfaiframework=get_pages',
            url: $('#load_link_route').val(),
            dataType: 'html',
            success: function(data) {
                $('#content_crud').html(data);
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function jadikan_default_pengiriman(id_bangunan) {
        $.ajax({
            type: 'POST',
            data: '&id_bangunan=' + id_bangunan +
                '&link_route=' + $('#load_link_route').val() +
                '&apps=Inventaris_aset' +
                '&page_view=bangunan' +
                '&type=jadikan_default_pengiriman' +
                '&not_sidebar=not' +
                '&no_button_vte=not' +
                '&sub_kategori=not' +
                '&id=-1' +

                '&MainAll=2' +
                '&contentfaiframework=get_pages',
            url: $('#load_link_route').val(),
            dataType: 'html',
            success: function(data) {
                swal("Sukses!", "Alamat Default pengiriman barang sudah di perbaharui!", "success");
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function update_pemesanan() {
        var kirim_ke = 0;
        var payment = 0;
        var brand = 0;
        if (typeof $('input[name=kirim_ke]:checked').val() !== 'undefined') {
            // the variable is defined
            kirim_ke = $('input[name=kirim_ke]:checked').val();
        }

        if (typeof($('input[name=pembayaran]:checked').val()) !== 'undefined') {
            // the variable is defined
            payment = $('input[name=pembayaran]:checked').val();
        }

        if (typeof($('input[name=brand]:checked').val()) !== 'undefined') {
            // the variable is defined
            brand = $('input[name=brand]:checked').val();
        }
        $.ajax({
            type: 'POST',
            data: $('#formvte_fai_framework').serialize() +
                '&link_route=' + $('#load_link_route').val() +
                '&apps=' + $('#load_apps').val() +
                '&page_view=' + $('#load_page_view').val() +
                '&type=update_pemesanan' +
                '&id=' + $('#load_id').val() +
                '&id_pemesanan=' + $('#load_id').val() +
                '&kirim_ke=' + (kirim_ke) +
                '&payment=' + (payment) +
                '&brand=' + (brand)

                +
                '&MainAll=2' +
                '&contentfaiframework=get_pages',
            url: $('#load_link_route').val(),
            dataType: 'json',
            success: function(data) {
                if(data.status){
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil diupdate!",
                        icon: "success",
                    });
                }else{
                    swal({
                        title: "Gagal!",
                        text: "Data gagal diupdate!",
                        icon: "error",
                    });
                }
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }
</script>