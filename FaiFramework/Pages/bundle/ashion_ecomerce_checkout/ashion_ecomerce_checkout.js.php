<TO_SCRIPT></TO_SCRIPT>
<script>
      function cek_form(){
      var kirim_ke = 0;
        var payment = 0;
        var brand = 0;
        var total_kosong_ongkir = 0;
        $(".ongkir_terpilih").each(function(){
          if(!$(this).val()){
             total_kosong_ongkir++;
          }
        });

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
            if($('.ongkir_terpilih').length == 0 || total_kosong_ongkir > 0){
         swal('Gagal!', 'Ekspedisi dan Servise tidak boleh kosong', 'error');
        }else
        if(kirim_ke == 0){
         swal('Gagal!', 'Alamat Tujuan tidak boleh kosong', 'error');
         }else
        if(payment == 0){
         swal('Gagal!', 'Metode Pembayaran Tidak Boleh Kosong', 'error');
         }else
        if(brand == 0){
         swal('Gagal!', 'Brand Metode Pembayaran Tidak Boleh Kosong', 'error');
         }else {

        window.location.href='<BUAT_INVOICE></BUAT_INVOICE>' ;
      }
      }
</script>
