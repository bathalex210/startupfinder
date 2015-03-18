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
	<script type="text/javascript">
		function likeStartup(title) {
			$.post("functions/like.php", {title:title});
		}
		function dislikeStartup(title) {
			$.post("functions/dislike.php", {title:title});
		}
	</script>
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
			echo '<div class="startups">';
				$email = $_SESSION['email'];
				include 'functions/startup.php';
				loadStartups($email, ""); // Load all start-ups from user=$email
			echo '</div>';
			// Closing connection
			pg_close($dbconn);
		?>
	</div>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>

</html>