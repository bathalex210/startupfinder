<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Delete - StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/editstartup.css"> <!-- Profile CSS Styling -->
</head>
<?php
	session_start(); // Start PHP session to test if user is logged in.
	$email = $_SESSION['email'];
	if (!isset($email) || empty($email)) {
		// They are not logged in. Redirect to login page with note code 1.
		header("Location: http://startupfinder.herokuapp.com/login.php#note=1");
		die();
	}

	$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
		or die('Could not connect: ' . pg_last_error());
	
	function DeleteStartup() { 
		$title = $_POST['title'];
		$email = $_SESSION['email'];
		$query = "DELETE FROM startup WHERE title='$title' AND email='$email'"; 
		$data = pg_query($query) or die('Query failed: ' . pg_last_error()); 
		if($data) { //Update Success
			header("Location: http://startupfinder.herokuapp.com/profile.php");
			die();
		}
	}
	if(isset($_POST['submit'])) { DeleteStartup(); }
	// Closing connection
	pg_close($dbconn);
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
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend><span class="fa fa-trash-o fa-2x"></span>Delete Start-up</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='text' name='title' id='title' placeholder="Title of Startup"/>
				<input type='submit' name='submit' value='Submit' />	 
			</fieldset>
		</form>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>

</html>