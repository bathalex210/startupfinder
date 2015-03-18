<?php
	/**
	 * Function will load all start-ups. 
	 * If no title is included in the call of the function,
	 * all of the start-ups associated with the user will appear.
	 */
	function loadStartups($email, $title) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (empty($title)) {
			$query = "SELECT * FROM startup WHERE email='$email'";
		} else {
			$query = "SELECT * FROM startup WHERE email='$email' AND title='$title'";
		}
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		while ($data = pg_fetch_object($result)) {
			echo '<form action="editstartup.php" method="post" accept-charset="UTF-8">';
			echo '<input type="hidden" name="title" id="title" value="'.$data->title.'"/>';
			if (strcmp($_SESSION['email'],$email)==0) {
				echo '<button type="submit"><span class="fa fa-pencil fa-2x"></span></button>';
			}
			if (isset($_SESSION['email'])) {
				echo "<button type=\"button\" onclick=\"likeStartup('$data->title');\">LIKE!</button>";
				echo "<button type=\"button\" onclick=\"dislikeStartup('$data->title');\">DISLIKE!</button>";
			}
			echo '<h2>'.$data->title.'</h2>';
			echo '<p> Email: '.$data->description.'</p>';
			echo '<p> Email: '.$data->industry.'</p>';
			echo '<p> Email: '.$data->email.'</p>';
			echo '</form>';
		}
	}
?>