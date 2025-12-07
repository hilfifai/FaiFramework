
function reach_page_all_page() {

	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'template',
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {

			$('#AllContentLoad').html(data);
			
			load_navbar()
			load_header()
			load_sidebar()
			//load_sidebarin()
			load_buttombar()
			reach_page_first($('#load_apps').val(), $('#load_page_view').val(), $('#load_type').val(), $('#load_id').val());
			
			$('#example1').datatable(
				{
					responsive: true
				}
			);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});
}

function reach_page_view_website() {

	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'view_website_template',
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {

			$('#AllContentLoad').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});
}
