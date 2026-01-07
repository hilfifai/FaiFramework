<input type="hidden" id="id-mitra" value="">
<script>
   

    async function click_pembayaran(elem, id, total) {
        $('.radio-pembayarandiv').removeClass('selected-pembayarandiv');
        $(elem).addClass('selected-pembayarandiv');
        $('#val_total_pembayaran').val((total));
        let total_rupiah = await formatRupiah(total);
        console.log(total_rupiah);
        $('#total_pembayaran').html(total_rupiah);
        $('#id-mitra').val(id);
    }
</script>