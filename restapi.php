<?php
	if (!empty($_GET['best'])) {
		if (!empty($_GET['datestart']) && !empty($_GET['dateend']) && !empty($_GET['k'])) {
			bestIdeas($_GET['k'],$_GET['datestart'], $_GET['dateend']);
		}
	}
	function bestIdeas($k, $dateStart, $dateEnd) {
		$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
			or die('Could not connect: ' . pg_last_error());
		$query = "SELECT * FROM (SELECT startup.title,description,industry,startup.email,startup.date,count(rating) FROM startup,likes WHERE startup.title=likes.title AND rating='like' GROUP BY startup.title,description,industry,startup.email,startup.date ORDER BY count(rating) DESC LIMIT $k) AS bestideas WHERE date<='$dateEnd' AND date>='$dateStart'";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		echo "{";
		$i=0;
		while ($data = pg_fetch_object($result)) {
			$i++;
			echo "\"startup$i\":{";
			echo "\"title\":\"$data->title\",
					\"description\":\"$data->description\",
					\"industry\":\"$data->industry\",
					\"email\":\"$data->email\",
					\"date\":\"$data->date\"";
			echo "},";
		}
		echo "}";
	}
?>