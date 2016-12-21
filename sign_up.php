<?php
session_start();
include 'error_report.php';
include 'model/db_query.php';
include 'tools/email_operations.php';

if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
{
	$error = array();
	if (!$_POST["login"] || !$_POST["passwd"] || !$_POST["email"])
	array_push($error, "You need to fill in all the fields\n");
	else if (preg_match("/^[a-zA-Z0-9_]{1,16}$/", $_POST["login"]) == FALSE)
		array_push($error, "Login must be 16 characters max and contain only letters and numbers");
	else if (preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/", strtoupper($_POST["email"])) == FALSE)
		array_push($error, $_POST["passwd"] . " is not a valid email adress" );
	else if (preg_match("/\b.{4,}\b/", $_POST["passwd"]) == FALSE)
		array_push($error, "Password must contains 4-32 characters");

	if (!$error)
	{
		//	sanitize inputs :
		$login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
		
		//	check if login exists :
		$sql = " SELECT * FROM users WHERE login=:login ";
		$user_login = db_array_fetchAll($sql, array('login' => $login));
		if ($user_login)
			array_push($error, "This login is already taken\n");
		
		//	check if email exists :
		$sql = " SELECT * FROM users WHERE email=:email ";
		$user_email = db_array_fetchAll($sql, array('email' => $email));
		if ($user_email)
			array_push($error, "There is already an account associated to this email. Try loggin in.\n");
		if (!$user_login && !$user_email)
		{
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$activation = md5(uniqid(rand(0,1000)));
			$sql = "
				INSERT INTO users 
				VALUES ('0', :login, :email, '".$passwd."', '".$activation."', 'pending', '')";
			if (!db_execute($sql, array('login' => $login, 'email' => $email)))
				array_push($error, "Error: Could not add user to db\n");
			if (!send_activation_email($email, $login, $activation))
				array_push($error, "Error: Could not send mail");			
		}
	}
	if ($error){
		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
		header("Location: ./sign_up.php/?step=step2");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Camagru - Create Account</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/camagru/signup.css">
	<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php
	if (isset($_GET["step"]) && $_GET["step"] === "step2")
		include 'sign_up_step2.php';
	else
		include 'sign_up_step1.php';
	?>
</body></html>