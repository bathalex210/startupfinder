<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/index.css"> <!-- Index CSS Styling -->
</head>
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
		<div id="splash">
			<img src="/img/header.jpg"/>
			<h1>StartupFinder</h1>
			<p>Submit your start-up idea or browse others!</p>
			<span class="fa fa-arrow-circle-down fa-4x"></span>
		</div>
		<form id='register' action="register.php" method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend><span class="fa fa-user-plus fa-2x"></span>Register</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				<input type='text' name='name' id='name' maxlength="20" placeholder="Name"/>
				<input type='text' name='email' id='email' maxlength="50" placeholder="Email"/>
				<input type='password' name='pass' id='pass' maxlength="20" placeholder="Password"/>
				<input type='submit' name='submit' value='Submit' />	 
			</fieldset>
		</form>
    </section>
</body>
</html>
	