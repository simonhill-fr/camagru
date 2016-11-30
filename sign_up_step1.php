<?php

function username_exist()
{
	if ($_POST && $_POST["submit"] === "error")
	{
		echo $_POST["submit_err"];
	}
}

?> 


			<!-- Column 1 start -->
			<h2 style="text-align: center">Create new account :</h2>
			<h3><?php username_exist(); ?> </h3>
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