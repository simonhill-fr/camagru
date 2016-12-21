<?php
session_start();
include 'error_report.php';
require_once "model/Feed_Gallery.php";

if (isset($_POST["submit_like"]))
{
	$error = array();
	if (!$_POST["like_status"] || !$_POST["pic_id"])
		array_push($error, "Cannot send empty content");
	if (isset($_SESSION["user_id"]) === false)
		array_push($error, "Please login to like pictures");
	if (!$error)
	{
		$pic_id = filter_input(INPUT_POST, "pic_id", FILTER_SANITIZE_NUMBER_INT);
		$user_id = intval($_SESSION["user_id"]);
		if ($_POST["like_status"] === "cleared")
		{
			$sql = "
				INSERT INTO likes (pic_id, user_id)
				VALUES (:pic_id, '".$user_id."')
				";
			$sql_args = array('pic_id' => $pic_id);
		}
		else if ($_POST["like_status"] === "set")
		{
			$sql = "
				DELETE FROM likes 
				WHERE likes.user_id='".$user_id."'
				";
			$sql_args = NULL;
		}
		if (!db_execute($sql, $sql_args))
			array_push($error, "SQL request error");
	}
	if ($error)
		print_r($error);
	else
		header("Location: ./");
}


?>
