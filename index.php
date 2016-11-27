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
	<!-- <h1>Camagru is here !</h1> -->
<ul>
		<li style="float: left"><a href=""> <img src="images/camera-flat.png" width="32%"></a></li>
		<li><a href="">Logout</a></li>
		<li><a href="">Edit Profile</a></li>
	</ul>
</div>

<?php include "montage.php"; ?>

<div id="footer">
	<p style="text-align: center;"> (c) shill 2016 </p>
</div>

</body>
</html>
