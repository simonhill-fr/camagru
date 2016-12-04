<?php
session_start();
include 'config/setup.php';

if (isset($_GET["email"]) && isset($_GET["key"]))
{
	$error = array();
	if (preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/", strtoupper($_GET["email"])) == FALSE
		|| preg_match("/^[a-zA-Z0-9]{32}$/", $_GET["key"]) == FALSE)
		array_push($error, "Reset code error : wrong code url");
	if (!$error)
	{
		$db = db_connection();
		$search = $db->prepare("SELECT * FROM users 
			WHERE email='".$_GET["email"]."' 
			AND reset_key='".$_GET["key"]."'");
		$search->execute();
		$match = $search->fetchAll();
		if (!$match)
			array_push($error, "Reset code error : no match");
		else
		{
			$db->exec("UPDATE users SET reset_key = '' WHERE email='".$_GET["email"]."'");
			$db = NULL;
			$_SESSION["user"] = $match['0']['login'];
			header("Location: http://localhost:8080/camagru/");
		}
	}
	if ($error)
		echo $error[0];	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Camagru - Reset Password</title>
	<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>

</body>
</html>

