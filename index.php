<?php 
session_start();
include 'config/setup.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

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
		<li><a href="./?page=log_in">Log in</a></li>
		<li><a href="./?page=sign_up">Sign Up</a></li>
	</ul>
</div>
<?php
if (isset($_GET["page"])) {
	if ($_GET["page"] == "sign_up")
		include "sign_up.php";
	else if ($_GET["page"] == "log_in")
		include "log_in.php";
	else
		include "feed.php";
}
?>
<div id="footer">
	<p style="text-align: center;"> (c) shill 2016 </p>
</div>

</body>
</html>
