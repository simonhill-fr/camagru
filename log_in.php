<?php
session_start();
include 'model/db_query.php';

function no_match()
{
	if ($_POST && $_POST["submit"] === "error")
	{
		echo $_POST["submit_err"];
	}
}

if ($_POST["submit"] == "OK")
{
	$error = array();
	if (!$_POST["login"] || !$_POST["passwd"])
		array_push($error, "You need to fill in all the fields\n");
	if (!$error)
	{
		$hash_passwd = hash("whirlpool", $_POST["passwd"]);
		$db = db_connection();
		$search = $db->prepare("SELECT * FROM users 
			WHERE login='".$_POST["login"]."' 
			AND passwd='".$hash_passwd."'");
		$search->execute();
		$match = $search->fetchAll();
		if (!$match)
			array_push($error, "Login / password mismatch");
		$db = NULL;
		
	}
	if ($error)
	{
		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
	{
		$_SESSION["user"] = $_POST["login"];
		$_SESSION["user_id"] = $match["0"]["id"];
		header("Location: ./");
	}

}	

?>
<html>
<head>
		<!-- <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
		<title>Camagru - Log in</title>
		<link rel="stylesheet" type="text/css" href="./signup.css">
		<!-- <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'> -->
		<!-- <link rel="stylesheet" href="css/main.css"> -->
	</head>
	<body>

		<form action="./log_in.php" method="post">
			
			<h1>Log in</h1>
			
			<fieldset>
				<legend><?php no_match(); ?></legend>
				<label for="name">Login:</label>
				<input type="text" name="login">
				
				<label for="password">Password:</label>
				<input type="password" name="passwd">
			<a href="./request_new_pass.php"> Forgot password ? </a>	
			</fieldset>
			<button type="submit" name="submit" value="OK">Log in</button>
			<a href="./sign_up.php"> Don't have an account ? </a>
		</form>

	</body></html>



