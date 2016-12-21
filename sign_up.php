<?php
session_start();
include 'error_report.php';
function username_exist()
{
	if (isset($_SESSION["signup_err"]))
	{
		echo $_SESSION["signup_err"];
		unset($_SESSION["signup_err"]);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Camagru - Create Account</title>
	<link rel="stylesheet" type="text/css" href="signup.css">
	<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	<form action="./signup_handle.php" method="post">
	
	<h1>Sign Up</h1>
	
	<fieldset>
		<legend><span class="number">1</span><?php username_exist(); ?></legend>
		<label for="name">Login:</label>
		<input type="text" name="login">
		
		<label for="mail">Email:</label>
		<input type="email" name="email">
		
		<label for="password">Password:</label>
		<input type="password" name="passwd">
		
	</fieldset>
	<button type="submit" name="submit" value="OK">Sign Up</button>
	</form>


</body></html>