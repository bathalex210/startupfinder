<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Startup - StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/startup.css"> <!-- Register CSS Styling -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
		<?php
			// Connecting, selecting database
			$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
				or die('Could not connect: ' . pg_last_error());

			$startup = $_GET['title'];
			if (!empty($startup)) {
				$email = $_SESSION['email'];
				$query = "SELECT * FROM startup WHERE email='$email' AND title='$startup'";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				while ($data = pg_fetch_object($result)) {
					echo '<h2>'.$data->title.'</h2>';
					echo '<p> Email: '.$data->description.'</p>';
					echo '<p> Email: '.$data->industry.'</p>';
					echo '<p> Email: '.$data->email.'</p>';
				}
			} else {
				echo "Start Up does not exist.";
			}
			// Closing connection
			pg_close($dbconn);
		?>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>
</html>