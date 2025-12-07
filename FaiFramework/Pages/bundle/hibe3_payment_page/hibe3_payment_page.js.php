<script>
    function PaymentCollapse(elem) {

    }
    function click_pembayaran(elem,id) {
        $('.radio-pembayarandiv').removeClass('selected-pembayarandiv');
        $(elem).addClass('selected-pembayarandiv');
        const hasil = id.split("-");
        if(hasil[2]=='system'){
            $('#biaya_payment_system').val(hasil[3]);
            $('#biaya_payment_user').val(0);
        }else
        if(hasil[2]=='user'){
            $('#biaya_payment_user').val(hasil[3]);
            $('#biaya_payment_system').val(0);
            
        }
        $('#brand-pembayaran').val(id);
    }
</script>
