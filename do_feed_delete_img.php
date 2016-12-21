<?php
session_start();
include 'error_report.php';
require_once 'model/db_query.php';


if (isset($_POST["img_delete"])) {
	$img_to_delete = filter_input(INPUT_POST, "img_delete", FILTER_SANITIZE_URL);
	$sql = "
		DELETE FROM pictures 
		WHERE pictures.path = :img_to_delete
		";
	$sql_args = array('img_to_delete' => $img_to_delete);
	if (db_execute($sql, $sql_args))
	{
		if (!unlink($_POST['img_delete']))
			echo "Error deleting image file";
		header("Location: ./");
	}

}
?>