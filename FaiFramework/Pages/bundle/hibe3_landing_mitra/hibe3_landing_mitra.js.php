<input type="hidden" id="id-mitra" value="">
<script>
    function PaymentCollapse(elem) {

    }
    function click_pembayaran(elem,id,total) {
        $('.radio-pembayarandiv').removeClass('selected-pembayarandiv');
        $(elem).addClass('selected-pembayarandiv');
        $('#val_total_pembayaran').val((total)); 
        $('#total_pembayaran').html(formatRupiah(total));
         $('#id-mitra').val(id);
    }
</script>
 