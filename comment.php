<?php
session_start();
require_once 'tools/database_operations.php';

$db = new Connection();

if (isset($_POST["submit_comment"]))
{
	$error = array();
	if (!$_POST["comment_text"] || !$_POST["pic_id"])
		array_push($error, "Cannot send empty comment");
	if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === "")
		array_push($error, "Please login to post comments");
	if (!$error)
	{
		$text = $_POST["comment_text"];
		$pic_id = $_POST["pic_id"];
		$user_id = $_SESSION["user_id"];
		$sql = "INSERT INTO comments (pic_id, user_id, timestamp, text)
				VALUES ('".$pic_id."', '".$_SESSION['user_id']."', '".time()."', '".$text."' )";
		if (!($db->simplequery($sql)))
			array_push($error, "SQL request error");
		$db = NULL;
	}
	if ($error)
		print_r($error);
	else
		header("Location: http://localhost:8080/camagru/");
}

?>