<?php
	if (strcmp($_GET['best'],"true")==0) {
		if (!empty($_GET['datestart']) && !empty($_GET['dateend']) && !empty($_GET['k'])) {
			bestIdeas($_GET['k'],$_GET['datestart'], $_GET['dateend']);
		}
	} elseif (strcmp($_GET['graph'],"true")==0) {
		showGraph();
	}
	function bestIdeas($k, $dateStart, $dateEnd) {
		$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
			or die('Could not connect: ' . pg_last_error());
		$query = "SELECT * FROM (SELECT startup.title,description,industry,startup.email,startup.date,count(rating) FROM startup,likes WHERE startup.title=likes.title AND rating='like' GROUP BY startup.title,description,industry,startup.email,startup.date ORDER BY count(rating) DESC LIMIT $k) AS bestideas WHERE date<='$dateEnd' AND date>='$dateStart'";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$str = "{";
		$i=0;
		while ($data = pg_fetch_object($result)) {
			$i++;
			$str .= "\"startup$i\":{";
			$str .= "\"title\":\"$data->title\",
					\"description\":\"$data->description\",
					\"industry\":\"$data->industry\",
					\"email\":\"$data->email\",
					\"date\":\"$data->date\"";
			$str .= "},";
		}
		$str = rtrim($str, ",");
		$str .= "}";
		echo $str;
	}
	
	function showGraph() {
		
		dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
			or die('Could not connect: ' . pg_last_error());
		$query = "SELECT * FROM (SELECT count(industry) AS health FROM startup WHERE industry='health') As health,
					(SELECT count(industry) AS education FROM startup WHERE industry='education') AS edu,
					(SELECT count(industry) AS travel FROM startup WHERE industry='travel') AS travel,
					(SELECT count(industry) AS technology FROM startup WHERE industry='technology') AS tech,
					(SELECT count(industry) AS finance FROM startup WHERE industry='finance') AS finance";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$data = pg_fetch_object($result);
		$health = $data->health;
		$education = $data->education;
		$travel = $data->travel;
		$technology = $data->technology;
		$finance = $data->finance;
		/*
		echo "
			<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>
			<script src=\"http://code.highcharts.com/highcharts.js\"></script>
			<script src=\"http://code.highcharts.com/modules/exporting.js\"></script>
			<div id=\"container\" style=\"min-width: 310px; height: 400px; margin: 0 auto\"></div>";
		echo "
		$(function () {
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Monthly Average Rainfall'
				},
				subtitle: {
					text: 'Source: WorldClimate.com'
				},
				xAxis: {
					categories: [
						'Health',
						'Education',
						'Technology',
						'Finance',
						'Travel'
					],
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Number of Start-Ups'
					}
				},
				tooltip: {
					headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
					pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
						'<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Health',
					data: [$health, 0, 0, 0, 0]

				}, {
					name: 'Education',
					data: [0, $education, 0, 0, 0]

				}, {
					name: 'Technology',
					data: [0, 0, $technology, 0, 0]

				}, {
					name: 'Finance',
					data: [0, 0, 0, $finance, 0]

				}, {
					name: 'Travel',
					data: [0, 0, 0, 0, $travel]
				}]
			});
		});";
	*/}
?>