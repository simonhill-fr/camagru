<?php
session_start();
include 'config/setup.php';

function send_reset_email($email, $reset_key)
{
	$to = $email;
	$subject = "Forgotten password";
	$link = "http://localhost:8080/camagru/reset.php/?email=".$email."&key=".$reset_key."";
	$message = "
	Hello, please click on the link below to reset password : <br>\n
	<a href='".$link."' target='_blank'> Reset Password </a>
	";
	$headers  = "From: camagru < noreply@camagru.com >\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
	$sent = mail($to, $subject, $message, $headers);
	if (!$sent)
		echo "Error sending email";
}

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
	if (!$_POST["email"])
		array_push($error, "You need to fill in all the fields\n");
	if (!$error)
	{
		$db = db_connection();
		$search = $db->prepare("SELECT * FROM users 
			WHERE email='".$_POST["email"]."'");
		$search->execute();
		$match = $search->fetchAll();
		if (!$match)
			array_push($error, "No such email in db, remove this message");
		else
		{
			$reset_key = md5(uniqid(rand(0,1000)));
			$db->exec("UPDATE users SET reset_key = '".$reset_key."' WHERE email='".$_POST["email"]."'");
			send_reset_email($_POST["email"], $reset_key);
			$db = NULL;
		}
		
	}
	if ($error)
	{
		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
	{

		echo "mail sent";
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

		<form action="./request_new_pass.php" method="post">
			
			<h1>Enter account email</h1>
			
			<fieldset>
				<legend><span class="number">1</span><?php no_match(); ?></legend>
				<label for="name">Email:</label>
				<input type="text" name="email">
			
			</fieldset>
			<button type="submit" name="submit" value="OK">Reset Password</button>
		</form>

	</body></html>