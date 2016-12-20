<?php

function username_exist()
{
	if ($_POST && $_POST["submit"] === "error")
	{
		echo $_POST["submit_err"];
	}
}
?> 
<form action="./sign_up.php" method="post">
	
	<h1>Sign Up</h1>
	
	<fieldset>
		<legend><span class="number">1</span><?php username_exist(); ?></legend>
		<label for="name">Login:</label>
		<input type="text" name="login">
		
		<label for="mail">Email:</label>
		<input type="email" name="email">
		
		<label for="password">Password:</label>
		<input type="password" name="passwd">
		
	</fieldset>
	<button type="submit" name="submit" value="OK">Sign Up</button>
</form>
