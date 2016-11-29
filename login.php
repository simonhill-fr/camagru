<?php 
//session_start();
include 'sql_connect.php'

?>



<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Create new account :</h2>
			<div>
				<form action="./?page=login" method="post">
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