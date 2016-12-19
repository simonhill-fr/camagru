<?php

require 'database.php';

$path = "../../../bin/mysql ";

$query = "
	DROP DATABASE IF EXISTS db_camagru;
	CREATE DATABASE db_camagru;
	use db_camagru;
	SOURCE db_camagru.sql;
	";

$cmd = $path
	. "--execute='".$query."'";

echo shell_exec($cmd);

?>