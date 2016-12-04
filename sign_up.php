<?php
session_start();
include 'config/setup.php';
include 'form_handling.php'

?>
<!DOCTYPE html>
<html>
	<head>
        <!-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <title>Camagru - Create Account</title>
        <link rel="stylesheet" type="text/css" href="./signup.css">
        <!-- <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'> -->
        <!-- <link rel="stylesheet" href="css/main.css"> -->
    </head>
    <body>
				<?php
				if (isset($_GET["step"]) && $_GET["step"] === "step2")
					include 'sign_up_step2.php';
				else
					include 'sign_up_step1.php';
				?>
</body></html>