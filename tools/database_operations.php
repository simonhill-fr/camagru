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

?>