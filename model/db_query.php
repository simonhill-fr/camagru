<?php

function db_connection() {

	require 'config/database.php';
	$dbh = NULL;
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch (PDOException $e) {
		header("Location: error.php?ernum=1");
	}
	return ($dbh);
}

function db_array_fetchAll($sql, $sql_args)
{
	if (!$db = db_connection())
		die("dbconnection error");
	
	try {
		$stmt = $db->prepare($sql);
	} catch (Exception $e) {
		header("Location: error.php?ernum=1");
	}
	$stmt->execute($sql_args);
	$result_array = $stmt->fetchAll();
	$db = NULL;
	return ($result_array);
}

function db_execute($sql, $sql_args)
{
	$db = db_connection();
	try {
		$stmt = $db->prepare($sql);
	} catch (Exception $e) {
		header("Location: error.php?ernum=1");
	}
	$ret = $stmt->execute($sql_args);
	$db = NULL;
	return ($ret);
}

?>