<link rel="stylesheet" href="<?=base_url('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
<link rel="stylesheet" href="<?=base_url('vendor/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
<link href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.min.js"></script>
<script src="<?=base_url('vendor/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('vendor/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('vendor/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
		
		<script>
			$(function () {
				$("#example1").DataTable({
						"responsive": true,
						"autoWidth": false,
					});
				$('#example2').DataTable({
						"paging": true,
						"lengthChange": false,
						"searching": false,
						"ordering": true,
						"info": true,
						"autoWidth": false,
						"responsive": true,
					});
			});
		$('.select2').select2()
		$('.select3').select2();
		//Initialize Select2 Elements
		$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
    
	</script><script>
		</script>