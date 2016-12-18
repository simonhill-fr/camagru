<?php

function db_array_fetchAll($sql)
{
	$db = db_connection();
	$search = $db->prepare($sql);
	$search->execute();
	$result_array = $search->fetchAll();
	$db = NULL;
	return ($result_array);

}

function db_execute($sql)
{
	$db = db_connection();
	$ret = $db->exec($sql);
	$db = NULL;
	return ($ret);
}

Class Connection {
	
	public	$handle = NULL;

	function __construct()	{
		try {
			$dbh = new PDO("mysql:host=localhost;dbname=db_camagru", "", "");
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $e) {
			header("Location: ../error.php?ernum=1");
			
		}
		$this->handle = $dbh;
	}
	
	function db_array_fetchAll($sql) {
		$search = $this->handle->prepare($sql);
		$search->execute();
		$result_array = $search->fetchAll();
		return ($result_array);
	}

	function simplequery($sql)	{
		return ($this->handle->exec($sql));
	}
}

?>