<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>API Test - StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/apitest.css"> <!-- Api Test CSS Styling -->

<!-- THESE 3 JAVASCRIPT IMPORTS ARE USED IN API AND MUST BE IMPORTED FOR GRAPH API-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
	$(function() {
		$.get( "restapi.php", {best: "true", datestart: "2015-03-01",dateend: "2015-03-21",k:5}).done(function(data) {
			$("#topfive").html(data);
		});
		$.get( "restapi.php", {graph: "true"}).done(function(data) {
			$("#distribution").html(data);
		});
	});
</script>
</head>
<body>
	<?php
		session_start();
		include 'functions/menu.php';
		if (isset($_SESSION['email'])) {
			userMenu();
		} else {
			defaultMenu();
		}
	?>
	<section>
	<h2>Top 5 Start-Ups (JSON format)</h2>
	<p>URL: <a href="http://startupfinder.herokuapp.com/restapi.php?best=true&datestart=2015-03-01&dateend=2015-03-21&k=5">http://startupfinder.herokuapp.com/restapi.php?best=true&datestart=2015-03-01&dateend=2015-03-21&k=5</a></p>
	<div id="topfive"></div>
	<h2>Start-Up Distribution</h2>
	<p>URL: <a href="http://startupfinder.herokuapp.com/restapi.php?graph=true">http://startupfinder.herokuapp.com/restapi.php?graph=true</a></p>
	<div id="distribution"></div>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>

</html>