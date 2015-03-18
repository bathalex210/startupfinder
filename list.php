<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- For MOBILE -->
<title>Start-Up List - StartupFinder</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> <!-- Google Font Import -->
<link rel="stylesheet" href="CSS/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="CSS/global.css"> <!-- Global CSS Styling -->
<link rel="stylesheet" type="text/css" href="CSS/list.css"> <!-- Profile CSS Styling -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
	<script type="text/javascript">
		function likeStartup(title) {
			$.post("functions/like.php", {title:title});
		}
		function dislikeStartup(title) {
			$.post("functions/dislike.php", {title:title});
		}
	</script>
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
	<aside>
		<?php 
		function ascendVSdescend($att) {
			$str="";
			switch($_GET['order']){
				case $att.' asc':$str='desc';break;
				case $att.' desc':$str='asc';break;
				default: $str='asc';
			}
			return $str;
		}
		function isActive($att) {
			if (srtcmp($att, $_GET['order'])==0) {
				return "active";
			} else {
				return "";
			}
		}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
		<input type="hidden" name="q" value="<?php echo $_GET['q'];?>" />
		<input type="hidden" name="order" value="title <?php echo ascendVSdescend('title');?>" />
		<button class="<?php echo isActive('title');?>" type="submit">
			<span class="fa fa-random"></span>Title<span class="fa fa-sort-alpha-<?php echo ascendVSdescend('title');?>"></span>
		</button>
		</form>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
		<input type="hidden" name="q" value="<?php echo $_GET['q'];?>" />
		<input type="hidden" name="order" value="industry <?php echo ascendVSdescend('industry');?>" /> 
		<button class="<?php echo isActive('industry');?>" type="submit">
			<span class="fa fa-briefcase"></span>Industry<span class="fa fa-sort-alpha-<?php echo ascendVSdescend('industry');?>"></span>
		</button>	
		</form>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
		<input type="hidden" name="q" value="<?php echo $_GET['q'];?>" />
		<input type="hidden" name="order" value="description <?php echo ascendVSdescend('description');?>" /> 
		<button class="<?php echo isActive('description');?>" type="submit">
			<span class="fa fa-pencil-square-o"></span>Description<span class="fa fa-sort-alpha-<?php echo ascendVSdescend('description');?>"></span>
		</button>
		</form>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
		<input type="hidden" name="q" value="<?php echo $_GET['q'];?>" />
		<input type="hidden" name="order" value="date <?php echo ascendVSdescend('date');?>" /> 
		<button class="<?php echo isActive('date');?>" type="submit">
			<span class="fa fa-calendar"></span>Date<span class="fa fa-sort-alpha-<?php echo ascendVSdescend('date');?>"></span>
		</button>	
		</form>
	</aside>
	<section>
		<?php
			$search=$_GET['q'];
			$order=$_GET['order'];
			if (empty($order)) {$order="title";}
			// Connecting, selecting database
			$dbconn = pg_connect("host=ec2-23-23-215-150.compute-1.amazonaws.com dbname=d2psqpda41ih1k user=tfqyqshbouweik password=P3mnTBRoi6sqF6oqcvU3ruO2kS")
				or die('Could not connect: ' . pg_last_error());
		
			include 'functions/startup.php';
			loadStartups("SELECT * FROM startup WHERE LOWER(title) LIKE LOWER('%$search%') ORDER BY $order;");
			// Closing connection
			pg_close($dbconn);
		?>
	</section>
	<footer><?php include 'functions/footer.php'; showFooter();?></footer>
</body>

</html>