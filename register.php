<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Register - SynergySpace</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/register.css"> <!-- Register CSS Styling -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript" async>
	$(function() { //Document Ready Function
		if(window.location.hash.localeCompare("#error=useremail")==0) {
			alert("That email or username is already in use. Please try another.");
		}
	});
</script>
</head>
<?php
session_start(); // Start PHP session to test if user is logged in.
// Connecting, selecting database
$dbconn = pg_connect("host=ec2-107-20-244-39.compute-1.amazonaws.com dbname=ddn82pff17m8p9 user=vbbkmqgcbmprhj password=hgtlv6g35Sn0zxepyM-f7JKqK6")
    or die('Could not connect: ' . pg_last_error());

function NewUser() { 
	$fullname = $_POST['name']; 
	$userName = $_POST['user']; 
	$email = $_POST['email']; 
	$password = md5($_POST['pass']); 
	$type = $_POST['type']; 
	$query = "SET search_path TO synergy; INSERT INTO users (username,password,name,email,type) VALUES ('$userName','$password','$fullname','$email','$type')"; 
	$data = pg_query($query) or die('Query failed: ' . pg_last_error()); 
	if($data) { //Registration successful
		header("Location: http://synergyspace309.herokuapp.com/login.php#user=".$userName);
        die();
	}
}

function SignUp() { 
	if(!empty($_POST['user'])) {
		$query = pg_query("SET search_path TO synergy; SELECT * FROM users WHERE userName = '$_POST[user]' OR email = '$_POST[email]'")
			or die('Query failed: ' . pg_last_error()); 
		if(pg_num_rows($query) == 0) { NewUser(); } 
		else {//Username or Email taken
			header("Location: http://synergyspace309.herokuapp.com/register.php#error=".useremail);
            die();
		} 
	} 
} 
if(isset($_POST['submit'])) { SignUp(); }

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
		<form id='register' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend><span class="fa fa-user-plus fa-2x"></span>Register</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='text' name='name' id='name' maxlength="20" placeholder="Name"/>
				<input type='text' name='email' id='email' maxlength="50" placeholder="Email"/>
				<input type='text' name='user' id='user' maxlength="20" placeholder="Username"/>
				<input type='password' name='pass' id='pass' maxlength="20" placeholder="Password"/>
				<input type="radio" name="type" value="tenant">Tenant
				<input type="radio" name="type" value="leaser">Leaser
				<input type='submit' name='submit' value='Submit' />	 
			</fieldset>
		</form>
	</section>
	<footer><a href="https://synergyspace309.herokuapp.com/">SynergySpace</a> is a coworking space rental and teaming to succeed service. &copy; 2015</footer>
</body>
</html>