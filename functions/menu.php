<?php
function defaultMenu () {
	echo 
		'<header>
			<a href="/index.php"><span class="fa fa-connectdevelop fa-2x"></span><span>SynergySpace</span></a>
			<div id="account">
				<ul>
					<li><a href="/register.php"><span class="fa fa-plus"></span>Create an Account</a></li>
					<li><a href="/list.php"><span class="fa fa-search"></span>Browse Start-Ups</a></li>
					<li><a href="/login.php"><span class="fa fa-sign-in"></span>Login</a></li>
				</ul>
			</div>
		</header>';
}
function userMenu() {
	echo 
		'<header>
			<a href="/index.php"><span class="fa fa-connectdevelop fa-2x"></span><span>SynergySpace</span></a>
			<div id="account">
				<ul>
					<li><a href="/newstartup.php"><span class="fa fa-plus"></span>New Start-Up</a></li>
					<li><a href="/list.php"><span class="fa fa-search"></span>Browse Start-Ups</a></li>
					<li><a href="/profile.php"><span class="fa fa-cogs"></span>My Account</a></li>
					<li><a href="/login.php"><span class="fa fa-sign-out"></span>Logout</a></li>
				</ul>
			</div>
		</header>';
}
?>