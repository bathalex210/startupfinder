<?php
	session_start(); // Start PHP session to test if user is logged in.
	$email = $_SESSION['email'];
	if (!isset($email) || empty($email)) {
		// They are not logged in. Redirect to login page with note code 1.
		header("Location: http://startupfinder.herokuapp.com/login.php#note=1");
		die();
	}
	// Connecting, selecting database
	$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
		or die('Could not connect: ' . pg_last_error());
	
	$title = $_POST['title'];
	$query = "INSERT INTO likes (email,title,rating) VALUES ('$email','$title','like')"; 
	$data = pg_query($query) or die('Query failed: ' . pg_last_error()); 
	if($data) { //Liked
        die();
	}
?>