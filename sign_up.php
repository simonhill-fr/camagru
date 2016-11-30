<?php
if ($bdd = mysqli_connect("localhost", "", "", "db_camagru"))
	{}
	else
		echo "Data base connexion fail\n";

if (isset($_POST["submit"]) && $_POST["submit"] === "OK")
{
	$error = array();
	if (!$_POST["login"] || !$_POST["passwd"] /*|| $_POST["email"]*/)
		array_push($error, "Tous les champs sont obligatoires\n");
	if (!$error)
	{
		$users = mysqli_query($bdd, "SELECT * FROM users WHERE login='".$_POST["login"]."'");
		$user = mysqli_fetch_array($users);
		if (!$user)
		{
			$empty = 0;
			$login = $_POST["login"];
			$email = $_POST["email"];
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$sql = "INSERT INTO users VALUES ('".$empty."', '".$login."', '".$email."', '".$passwd."')";
			if (mysqli_query($bdd, $sql))
				{}
			else
				array_push($error, "Une erreur s'est produite\n");
			mysqli_close($bdd);
		}
		else 
			array_push($error, "Ce login existe deja\n");
	}
	if ($error){

		$_POST["submit"] = "error";
		$_POST["submit_err"] = $error[0];
	}
	else
	{
		$_POST["submit"] = "STEP2";
	}
}

?>
<html><body>
<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<?php
			if (isset($_POST["submit"]) && $_POST["submit"] === "STEP2")
				include 'sign_up_step2.php';
			else
				include 'sign_up_step1.php';
			?>
		</div>
	</div>
</div>
</body></html>