<?php
session_start();
include 'config/setup.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Camagru - Email Verification</title>
	<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
<?php

if (isset($_GET["login"]) && isset($_GET["key"]))
{
	$error = array();
	if (preg_match("/^[a-zA-Z0-9_]{1,16}$/", $_GET["login"]) == FALSE
		|| preg_match("/^[a-zA-Z0-9]{32}$/", $_GET["key"]) == FALSE)
		array_push($error, "Activation code error : wrong code url");
	if (!$error)
	{
		$db = db_connection();
		$search = $db->prepare("SELECT * FROM users 
			WHERE login='".$_GET["login"]."' 
			AND activation='".$_GET["key"]."'");
		$search->execute();
		$match = $search->fetchAll();
		if (!$match)
			array_push($error, "Activation code error : no match");
		else if ($match["0"]["status"] === "active")
			array_push($error, "Your account is already activated");
		else
		{
			echo "success";
			$db->exec("UPDATE users SET status = 'active' WHERE login='".$_GET["login"]."'");
			$db->exec("UPDATE users SET activation = '' WHERE login='".$_GET["login"]."'");
			$db = NULL;
		}
	}
	if ($error)
		echo $error[0];	
}
?>
</body>
</html>

