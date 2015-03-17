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

	$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
		or die('Could not connect: ' . pg_last_error());
	
	function UpdateStartup() { 
		$title = $_POST['title'];
		$newTitle = $_POST['newtitle'];
		$desc = $_POST['description'];
		$industry = $_POST['industry'];
		$email = $_SESSION['email'];
		$query = "UPDATE startup SET title='$newTitle', description='$desc', industry='$industry' WHERE title='$title' AND email='$email'"; 
		$data = pg_query($query) or die('Query failed: ' . pg_last_error()); 
		if($data) { //Update Success
			header("Location: http://startupfinder.herokuapp.com/startup.php?title=".$newTitle."&user=".$email);
			die();
		}
	}
	if(isset($_POST['submit'])) { UpdateStartup(); }
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
	<form id='register' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' accept-charset='UTF-8'>
		<fieldset >
			<legend><span class="fa fa-pencil fa-2x"></span>Edit Start-up</legend>
			<input type='hidden' name='submitted' id='submitted' value='1'/>
			<input type='hidden' name='title' id='title' value='<?php $_POST['title']; ?>'/>
			<input type='text' name='newtitle' id='newtitle' maxlength="20" placeholder="New Title"/>
			<textarea name='description' id='description'>New Description of the Start Up</textarea>
			<select id='industry' name='industry'>
				<option value="health">Health</option>
				<option value="technology">Technology</option>
				<option value="education">Education</option>
				<option value="finance">Finance</option>
				<option value="travel">Travel</option>
			</select>
			<input type='submit' name='submit' value='Submit' />	 
		</fieldset>
	</form>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>

</html>