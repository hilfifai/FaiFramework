function validation(){
	
var result= 0;

if(result==0)
	return 1;
else
	return 0;


}

function readURL(input,field)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();
			reader.onload = function (e)
			{
				$('#imagePreview'+field).attr('style', 'background-image: url('+e.target.result+');border-radius: 18px 47px;');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	function change_wizard_form_id_provinsi_domisili (value){
   	var return_data = 0;
$.ajax({
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=wizard_form'
			                + '&id='+$('#load_id').val()
			                + '&value_input=id_provinsi_domisili'
			                + '&contentfaiframework=pages',
	                url: $('#load_link_route').val(),
	                dataType: 'html',
	                success: function(data) {
	                	
	                	$('#id_kota_domisili0').html(data);
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	          
	            return return_data;
}

	
	function change_wizard_form_id_kota_domisili (value){
   	var return_data = 0;
$.ajax({
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=wizard_form'
			                + '&id='+$('#load_id').val()
			                + '&value_input=id_kota_domisili'
			                + '&contentfaiframework=pages',
	                url: $('#load_link_route').val(),
	                dataType: 'html',
	                success: function(data) {
	                	
	                	$('#id_kecamatan_domisili0').html(data);
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	          
	            return return_data;
}

	
	function change_wizard_form_id_kecamatan_domisili (value){
   	var return_data = 0;
$.ajax({
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=wizard_form'
			                + '&id='+$('#load_id').val()
			                + '&value_input=id_kecamatan_domisili'
			                + '&contentfaiframework=pages',
	                url: $('#load_link_route').val(),
	                dataType: 'html',
	                success: function(data) {
	                	
	                	$('#id_kelurahan_domisili0').html(data);
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	          
	            return return_data;
}
