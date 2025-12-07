	 <form method="POST" id="formvte_fai_framework">
<section class="min-vh-100 mb-8">
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg">
<div class="container">
		          
      <TOP></TOP>
	
	<div class="row ">
		<div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
			<div class="card z-index-0">
			<div class="card-body">
			
				<TITLE></TITLE>
				
				<div class="card-body">
					 <FORM-CONTENT></FORM-CONTENT>
					</p>
				</div>
				<FOOTERCONTENT></FOOTERCONTENT>
			</div>
		</div>
	</div>
</div>
</form>






<script>

	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
	$(function ()
		{
			//Initialize Select2 Elements
			$('.select2').select2()

		})
	
	function quick_view(url)
	{
		window.location.replace(url);
	}
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan)
		{
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	function save_session()
	{
		var formData = new FormData($('#myFirstSession')[0]);
		var url='http://localhost/Server/hibe3/home/save_session/' ;
		//alert('hallo');
		$.ajax(
			{
				url : url,
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				//dataType: "JSON",
				success: function (data,textStatus,xhr)
				{
					//alert(data);

					//alert('sukses');;
					location.reload();

				},
				error: function(error)
				{
					//alert(error);
					console. log(error)

				}
			})	;
	}


<!--
	
//-->

function check_login(){
	var result = true;
	$.ajax({
		type:"POST",
		url:"<? base_url();?>auth/check_login/live_check",
		cache:false,
		dataType: "JSON",
		data:{
			usermail:$("#usermail").val(),
			password:$("#password").val(),
			
		},
		success:function(data){
			//alert(data);
			if(data.status){
				
				result = true;
				Show_alert('Berhasil Login.','success alert-important alert-dismissible','svg-checklis');
			}else{
				
				result = false;
				Show_alert('Username/Email dan Password Belum tepat','danger alert-important alert-dismissible','svg-danger');
			}
				
			
			//$("#user-availability-status").html(data);
			
		}
	});
	return result;

}
function submit_login1(){
	
	alert(check_login());
	if(check_login()==1){
			
			
			document.getElementById("form-login").submit();
			
	}
}
function show_password(){
	

var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
 }
</script></section>