<?php
session_start();
include 'config/setup.php';
include 'tools/database_operations.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Camagru - Email Verification</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/camagru/signup.css">
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
			$sql = "SELECT * FROM users WHERE login='".$_GET["login"]."' AND activation='".$_GET["key"]."'";
			$match = db_array_fetchAll($sql);
			if (!$match)
				array_push($error, "Activation code error : no match");
			else if ($match["0"]["status"] === "active")
				array_push($error, "Your account is already activated");
			else if (!mkdir("./user_img/" . $match[0][0]))
				array_push($error, "Error creating user folder");
			else if (!db_execute("UPDATE users SET status='active', activation = '' WHERE login='".$_GET["login"]."'"))
				array_push($error, "Error updating database");
			else
			{
				include 'public/email_verify_success.html';
			}
}
if ($error)
	echo $error[0];	
}

?>
</body>
</html>

