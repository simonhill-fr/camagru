<?php 
session_start();
include 'error_report.php';
require_once 'model/db_query.php';
db_connection();
	
?>
<html>
<head>
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
