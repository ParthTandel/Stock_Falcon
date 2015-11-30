<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highstock with dynamic data</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
		function graph()
		{
		$(function() {

		$.getJSON('csvparse.php?callback=?&sn=ACC.ns', function(data) {
				// Create the chart
				$('#container').highcharts('StockChart', {
					rangeSelector : {
						selected : 1
					},
		
					title : {
						text : 'IDEA'
					},
					
					series : [{
						name : 'IDEA',
						data : data,
						tooltip: {
							valueDecimals: 1
						}
					}]
				});
			});
		
		});
	}
		
		</script>
	    <script src="http://code.highcharts.com/stock/highstock.js"></script>
		<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>


	</head>
	<body>
		<div id="container" style="height: 500px; min-width: 500px"></div>
		<button onclick="graph()">graph</button>
	</body>
</html>