<?php

if ($bdd = mysqli_connect("localhost", "", "", "db_camagru"))
	{
		echo "estblished connexion";
	}
	else
		echo "Data base connexion fail\n";

if ($_POST["submit"] == "OK")
{
	$error = array();
	if (!$_POST["login"] || !$_POST["passwd"] /*|| $_POST["email"]*/)
		array_push($error, "Tous les champs sont obligatoires\n");
	if (!$error)
	{
		$users = mysqli_query($bdd, "SELECT * FROM users WHERE login='".$_POST["login"]."'");
		print_r($users);
//		$user = mysqli_fetch_array($users);
		$user = 0;
		if (!$user)
		{
			$empty = 0;
			$droit = 0;
			$login = $_POST["login"];
			$passwd = hash("whirlpool", $_POST["passwd"]);
			$sql = "INSERT INTO users VALUES ('".$empty."', '".$login."', '".$passwd."', '".$droit."')";
			if (mysqli_query($bdd, $sql))
				echo "Votre compte a ete cree\n";
			else
				echo "Une erreur s'est produite\n";
			mysqli_close($bdd);
		}
		else 
			array_push($error, "Ce login existe deja\n");
	}
	if ($error)
		echo $error[0];

}

?>



<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Create new account :</h2>
			<div>
				<form action="./?page=sign_up" method="post">
				<div>
					Login: <input type="text" name="login" />
				</div>
				<div>
					Email: <input type="text" name="email" />
				</div>
				<div>
					Pass: <input type="password" name="passwd" />
				</div>
				<div>
					<input type="submit" name="submit" value="OK" />
				</div>
				</form>
			</div>
			<!-- Column 1 end -->
		</div>
	</div>
</div>