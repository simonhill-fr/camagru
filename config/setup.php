<?php

function create_db() {

	$db = "db_camagru";

	$dbh = new PDO("mysql:host=localhost","","");
	$dbh->exec("CREATE DATABASE `$db`;");

	/*$sql = "CREATE TABLE `db_camagru`.`user` ( `id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `passwd` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";


	if ($dbh->exec($sql))
	{}
	else {
		echo "this is a failure<br>";
	}*/

	echo "created db";
}

function attempt_connection() {

	include 'database.php';
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//		echo "Database was found<br>";
	} 
	catch (PDOException $e) {
		echo 'Database not found, creating new db <br> ';
		create_db();

	}
}

attempt_connection();