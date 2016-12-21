<?php
session_start();
include 'error_report.php';
require_once 'model/db_query.php';
require_once 'tools/email_operations.php';

if (isset($_POST["submit_comment"]))
{
	$error = array();
	if (!$_POST["comment_text"] || !$_POST["pic_id"])
		array_push($error, "Cannot send empty comment");
	if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === "")
		array_push($error, "Please login to post comments");
	if (!$error)
	{
		$text = filter_input(INPUT_POST, "comment_text", FILTER_SANITIZE_STRING);
		$pic_id = filter_input(INPUT_POST, "pic_id", FILTER_SANITIZE_NUMBER_INT);
		$user_id = $_SESSION["user_id"];
		$sql = "
			INSERT INTO comments (pic_id, user_id, timestamp, text)
			VALUES (:pic_id, '".$_SESSION['user_id']."', '".time()."', :text )
			";
		if (!db_execute($sql, array("pic_id" => $pic_id, "text" => $text)))
			array_push($error, "SQL request error");
		$sql = "
			SELECT login, email
			FROM users
			INNER JOIN pictures
			WHERE pictures.id=:pic_id
			AND users.id=pictures.user_id
			";
		$to_user = db_array_fetchAll($sql, array("pic_id" => $pic_id));
		if (!send_comment_notif($to_user[0]["email"], $to_user[0]["login"], $text))
			array_push($error, "Error sending email");
	}
	if ($error)
		print_r($error);
	else
		header("Location: ./");
}

?>