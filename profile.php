<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			
			<div>

<form action="./?page=admin" method="post">
	Taper le login de l'utilisteur a modifier
	<br \>

	Login: <input type="text" name="login" />
	<br \>
	<input type="submit" name="submit" value="Chercher utilisateur" />
</form>

<form action="./?page=admin" method="post">
	
	ID	<input type="text" readonly="readonly" name="user_id" value="<?php echo $product[id]?>" />
	<br>
	Login: 			<input type="text"  name="login" value="<?php echo $product[login]?>" />
	<br>
	Passwd 			<input type="password"readonly="readonly" name="passwd" value="<?php echo $product[passwd]?>" />
	<br>
	Droits:			<input type="number" min="0" max="1" name="droit" value="<?php echo $product[droit]?>"/>
	<br>
	<br>
					<input type="submit" name="submit" value="Modifier utilisateur" />
	<br>
					<input type="submit" name="delete" value="Supprimer utilisateur" />
</form>

</form>


			</div>
			
			