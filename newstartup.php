<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>New Startup - StartupFinder</title>

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
// Connecting, selecting database
$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
    or die('Could not connect: ' . pg_last_error());

function NewStartup() { 
	$desc = $_POST['description']; 
	$email = $_SESSION['email'];
	$title = $_POST['title']; 
	$industry = $_POST['industry']; 
	$query = "INSERT INTO startup (description,email,title,industry) VALUES ('$desc','$email','$title', '$industry')"; 
	$data = pg_query($query) or die('Query failed: ' . pg_last_error()); 
	if($data) { //New Startup Created
		header("Location: http://startupfinder.herokuapp.com/startup.php?user=".$email."&title=".$title);
        die();
	}
}

if(isset($_POST['submit'])) { NewStartup(); }

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
				<legend><span class="fa fa-plus fa-2x"></span>Post New Startup</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='text' name='title' id='title' maxlength="20" placeholder="Title"/>
				<textarea name='description' id='description'>Description of the Start Up</textarea>
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