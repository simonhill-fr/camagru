<?php 

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

?>

<html>
<head>
	<title>Camagru - Edit and share your pictures</title>
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
</head>
<body>

<div id="header">
	
	<ul>
		<li style="float: left"><a href="./"> Home </a></li>
		<li><a href="./?page=login">Log in</a></li>
		<li><a href="./?page=signup">Sign Up</a></li>
	</ul>
</div>

<?php 
	if ($_GET["page"] == "signup")
		include "signup.php";
	else if ($_GET["page"] == "login")
		include "login.php";
	else
		include "feed.php";
?>	

<div id="footer">
	<p style="text-align: center;"> (c) shill 2016 </p>
</div>

</body>
</html>
