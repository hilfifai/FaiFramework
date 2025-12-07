
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Twitter meta-->


    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PO Sarimbit">
    <meta property="og:title" content="PO Sarimbit">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="PO Sarimbit Ethica">
    <title>@yield('title')POS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" href="{!! asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
    	<link rel="stylesheet" href="{!! asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('js/select2/css/select2.min.css') !!}">
	<link rel="stylesheet" href="{!! asset('js/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="">
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<!-- Sidebar menu-->

@yield('content') 

<!-- Essential javascripts for application to work-->
<script src="{{asset('/')}}js/jquery-3.2.1.min.js"></script>
<script src="{{asset('/')}}js/popper.min.js"></script>
<script src="{{asset('/')}}js/bootstrap.min.js"></script>
<script src="{{asset('/')}}js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('/')}}js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{asset('/')}}js/plugins/chart.js"></script>

<script src="{!! asset('plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
<script src="<?= url('plugins/purple/assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?= url('plugins/purple/assets/js/dataTables.bootstrap4.min.js')?>"></script>

<script type="text/javascript">
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
				$("#example3").DataTable({
					"responsive": true,
					"autoWidth": false,
				});$("#example4").DataTable({
					"responsive": true,
					"autoWidth": false,
				});$("#example5").DataTable({
					"responsive": true,
					"autoWidth": false,
				});$("#example6").DataTable({
					"responsive": true,
					"autoWidth": false,
				});$("#example7").DataTable({
					"responsive": true,
					"autoWidth": false,
				});
		});
</script>
<script type="text/javascript">
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86]
            }
        ]
    };
    var pdata = [
        {
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Complete"
        },
        {
            value: 50,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "In-Progress"
        }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<!-- Google analytics script-->
<script type="text/javascript">
    if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
@stack('js')
</body>
</html>