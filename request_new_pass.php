<?php
session_start();
require_once 'model/db_query.php';

function send_reset_email($email, $new_passwd)
{
	$to = $email;
	$subject = "Forgotten password";
	$message = "
	Hello, this is your new password : <br>\n
	".$new_passwd."
	";
	$headers  = "From: camagru < noreply@camagru.com >\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
	$sent = mail($to, $subject, $message, $headers);
	if (!$sent)
		return (false);
	else
		return (true);
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
		$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
		$sql = "
			SELECT * FROM users
			WHERE email=:email
			";
		$match = db_array_fetchAll($sql, array('email' => $email));
		if (!$match)
			array_push($error, "No such email in db, remove this message");
		else
		{
			$new_passwd = substr(md5(microtime()),rand(0,26),8);
			$new_passwd_hash = hash("whirlpool", $new_passwd);
			$sql = "
				UPDATE users
				SET passwd = '".$new_passwd_hash."'
				WHERE email=:email
				";
			if (!db_execute($sql, array('email' => $email)))
				array_push($error, "Error updating database");
			if (!send_reset_email($email, $new_passwd))
				array_push($error, "Error sending email");
		}		
	}
	if ($error)
	{
		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
	{
		header("Location: log_in.php");
	}

}	

?>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Camagru - Forgotten Password</title>
		<link rel="stylesheet" type="text/css" href="./signup.css">
		<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
	</head>
	<body>

		<form action="./request_new_pass.php" method="post">
			
			<h1>Enter account email</h1>
			
			<fieldset>
				<legend><?php no_match(); ?></legend>
				<label for="name">Email:</label>
				<input type="text" name="email">
			
			</fieldset>
			<button type="submit" name="submit" value="OK">Reset Password</button>
		</form>

	</body></html>