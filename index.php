<?php 
session_start();
include 'config/setup.php';
include 'tools/database_operations.php';
	/*REMOVE */
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	/*REMOVE */
?>
<html>
<head>
	<title>Camagru</title>
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
</head>
<body>

<div id="header">
	
	<ul>
		<li style="float: left"><a href="./"> Home </a></li>
		<?php
			if (isset($_SESSION["user"]) && $_SESSION["user"] !== "")
				include 'nav_user.php';
			else
				include 'nav_anonym.php'
		?>
	</ul>
</div>
<?php

if (isset($_GET["page"]))
{
	if ($_GET["page"] == "create")
		include "create.php";
}
else
	include "feed.php";

?>
<div id="footer">
	<p style="text-align: center;"> (c) shill 2016 </p>
</div>

</body>
</html>
