<?php 
session_start();
require_once 'model/db_query.php';
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
	<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
	<noscript>
		<h1><center>Javascript is disabled. You need to enable it to run Camagru</center></h1>
		<style type="text/css"> #main_content {display: none;} </style>
	</noscript>
</head>
<body><div id="main_content">


<div id="header">
	
	<ul>
		<li style="float: left"><a href="./"> Home </a></li>
		<?php
			if (isset($_SESSION["user"]) && $_SESSION["user"] !== "")
				include 'view/nav_user.html';
			else
				include 'view/nav_anonym.html'
		?>
	</ul>
</div>
<?php

if (isset($_GET["page"]))
{
	if ($_GET["page"] == "create" && isset($_SESSION["user"]) && $_SESSION["user"] !== "")
		include "create.php";
	else if ($_GET["page"] == "create" && (!isset($_SESSION["user"]) || $_SESSION["user"] === ""))
		include 'please_login.php';
}
else
	include "feed.php";

?>
<div id="footer">
	<p style="text-align: center; color: #dbdbdb;"> shill - 2016 </p>
</div>

</div></body>
</html>
