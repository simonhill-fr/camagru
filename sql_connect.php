<?php  

	if ($db = new PDO("mysql:host=localhost;dbname=db_camagru"))
		{}
	else
		echo "Data base connexion fail\n";
?>



<!-- $sql = 
"
INSERT INTO user (ID, login, email, passwd) 
VALUES (0, 'test', 'prout@caca.org', 'pss');
";

$ret = $db->exec($sql); -->