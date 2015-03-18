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
	<script type="text/javascript">
		function likeStartup() {
			$.post("functions/like.php", {title:getParameterByName('title')});
		}
		function dislikeStartup() {
			$.post("functions/dislike.php", {title:getParameterByName('title')});
		}
	</script>
	<section>
		<?php
			// Connecting, selecting database
			$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
				or die('Could not connect: ' . pg_last_error());

			$title = $_GET['title'];
			$email = $_GET['user'];
			if (!empty($title) && !empty($email)) {
				include 'functions/startup.php';
				loadStartups("SELECT * FROM startup WHERE email='$email' AND title='$title'");
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