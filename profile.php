<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Profile - StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/profile.css"> <!-- Profile CSS Styling -->
</head>
<?php
session_start(); // Start PHP session to test if user is logged in.
$email = $_SESSION['email'];
if (!isset($email) || empty($email)) {
      // They are not logged in. Redirect to login page with note code 1.
	  header("Location: http://startupfinder.herokuapp.com/login.php#note=1");
      die();
}
?>
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
	<div id="card">
		<?php
			$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
				or die('Could not connect: ' . pg_last_error());
			
			$query = "SELECT * FROM users WHERE email='$email'";
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			while ($data = pg_fetch_object($result)) {
				echo '<img src="http://www.adtechnology.co.uk/images/UGM-default-user.png">';
				echo '<h2>'.$data->name.'</h2>';
				echo '<p> Email: '.$data->email.'</p>';
			}
		?>
	</div>
	</section>
	<footer><a href="https://synergyspace309.herokuapp.com/">SynergySpace</a> is a coworking space rental and teaming to succeed service. &copy; 2015</footer>
</body>

</html>