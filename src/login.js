$(function() { //Document Ready Function
	var hash = window.location.hash;
	hash = hash.split("&"); //All of the URL after the # split on delimiter &
	for (i = 0; i < hash.length; i++) {
		displayNotes(hash[i]);
	}
	
	/**
	 * PRECOND: function has input String [hash]
	 * POSTCOND: Displays content to the user based on the hash of the page URL
	 */
	function displayNotes(hash) {
		if (hash.indexOf("user")!=-1) { // Fill username textbox
			document.getElementById('user').value=hash.split("=")[1];
		} else if (hash.indexOf("loggedout")!=-1) { // Logged out
			document.getElementById('notification').innerHTML="Logged out Successfully.";
		} else if (hash.indexOf("note")!=-1) { // Notifications
			switch (hash.split("=")[1]) {
				case "0":
					document.getElementById('notification').innerHTML="Username or password incorrect.";
					break;
				case "1":
					document.getElementById('notification').innerHTML="Please login to use that feature.";
					break;
				case "2":
					document.getElementById('notification').innerHTML="Password changed. Please log-in below.";
					break;
			}
		}
	}
});