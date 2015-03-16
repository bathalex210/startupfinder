<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Login - SynergySpace</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/login.css"> <!-- Global CSS Styling -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript" src="src/login.js"async></script>
</head>
<?php
/**
 * This page will loge users out if they are logged in by destroying session data.
 * After which, a user can login and be redirected to their profile.
*/

session_start(); // Start PHP session to test if user is logged in.
$username = $_SESSION['username'];
if (isset($username) || !empty($username)) { //Logged in
	session_destroy(); // Delete all data associated with user
	header("Location: http://synergyspace309.herokuapp.com/login.php#loggedout"); //Reload
}
// Connecting, selecting database
$dbconn = pg_connect("host=ec2-107-20-244-39.compute-1.amazonaws.com dbname=ddn82pff17m8p9 user=vbbkmqgcbmprhj password=hgtlv6g35Sn0zxepyM-f7JKqK6")
    or die('Could not connect: ' . pg_last_error());

function SignIn() {
	$userName = $_POST['user']; 
	$password = md5($_POST['pass']); 
	if(!empty($_POST['user'])) { 
		$query = "SET search_path TO synergy; SELECT * FROM synergy.users WHERE username='$userName' AND password='$password'";
		$result = pg_query($query) or die('Server error. Please try reloading <a href="http://synergyspace309.herokuapp.com/login.php">the login page</a>.');
		if(pg_num_rows($result) != 1) {
			//Reload page with note code: 0 - 'Username or password incorrect.'
			header("Location: http://synergyspace309.herokuapp.com/login.php#user=".$userName."&note=0");
		} else { //Logged in
			session_start();
			$_SESSION['username'] = $userName;
			header("Location: http://synergyspace309.herokuapp.com/profile.php"); //Redirect to Profile
			die();			
		}
	} 
}
if(isset($_POST['submit'])) {SignIn();}

// Closing connection
pg_close($dbconn);
?>
<body>
	<?php
		session_start();
		include 'functions/menu.php';
		if (isset($_SESSION['username'])) {
			userMenu();
		} else {
			defaultMenu();
		}
	?>
	<section>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			<fieldset>
				<legend><span class="fa fa-sign-in fa-2x"></span>LOG-IN</legend>
				<span id="notification"><?php function displayNote($note) {echo $note;}?></span>
				<input type="text" name="user" id="user" size="20" placeholder="Username"><br>
				<input type="password" name="pass" size="20" placeholder="Password"><br>
				<input id="button" type="submit" name="submit" value="Log-In"> 
			</fieldset>
		</form> 
	</section>
	<footer><a href="https://synergyspace309.herokuapp.com/">SynergySpace</a> is a coworking space rental and teaming to succeed service. &copy; 2015</footer>
</body>
</html>