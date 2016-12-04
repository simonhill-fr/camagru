<?php

function send_email($email, $login, $activation)
{
	$to = $email;
	$subject = "Vailidate account to complete registration";
	$link = "http://localhost:8080/camagru/verify.php/?login=".$login."&key=".$activation."";
	$message = "
	Hello ".$login." , please click on the link below to activate your account : <br>\n
	<a href='".$link."' target='_blank'> Activate </a>
	";
	$headers  = "From: camagru < noreply@camagru.com >\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
	$sent = mail($to, $subject, $message, $headers);
	if (!$sent)
		echo "Error sending email";
}

if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
{
	$error = array();
	if (!$_POST["login"] || !$_POST["passwd"] || !$_POST["email"]) //add regexp here
		array_push($error, "You need to fill in all the fields\n");
	else if (preg_match("/^[a-zA-Z0-9_]{1,16}$/", $_POST["login"]) == FALSE)
		array_push($error, "Login must be 16 characters max and contain only letters and numbers");
	else if (preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/", strtoupper($_POST["email"])) == FALSE)
		array_push($error, $_POST["passwd"] . " is not a valid email adress" );
	else if (preg_match("/\b.{1,}\b/", $_POST["passwd"]) == FALSE)
		array_push($error, "Password must contains 8-32 characters");

	if (!$error)
	{
		$db = db_connection();
		$users = $db->prepare("SELECT * FROM users WHERE login='".$_POST["login"]."'");
		$users->execute();
		$user = $users->fetchAll();
		if (!$user)
		{
			$empty = 0;
			$login = $_POST["login"];
			$email = $_POST["email"];
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$activation = md5(uniqid(rand(0,1000)));
			$sql = "INSERT INTO users 
					VALUES ('0', '".$login."', '".$email."', '".$passwd."', '".$activation."', 'pending', '')";
			if ($db->exec($sql))
				{}
			else
				array_push($error, "An error occured\n");
			send_email($email, $login, $activation);
			$db = NULL;
		}
		else 
			array_push($error, "This login is already taken\n");
	}
	if ($error){

		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
	{
		header("Location: ./sign_up.php/?step=step2");
	}
}


?>