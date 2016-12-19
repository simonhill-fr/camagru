<?php
session_start();

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
		$db = new Connection();
		$text = $_POST["comment_text"];
		$pic_id = $_POST["pic_id"];
		$user_id = $_SESSION["user_id"];
		$sql = "INSERT INTO comments (pic_id, user_id, timestamp, text)
				VALUES ('".$pic_id."', '".$_SESSION['user_id']."', '".time()."', '".$text."' )";
		if (!($db->simplequery($sql)))
			array_push($error, "SQL request error");
		$sql = "
		SELECT login, email
		FROM users
		INNER JOIN pictures
		WHERE pictures.id=".$pic_id."
		AND users.id=pictures.user_id
		";
		$to_user = $db->db_array_fetchAll($sql);
		if (!send_comment_notif($to_user[0]["email"], $to_user[0]["login"], $text))
			array_push($error, "Error sending email");
	}
	if ($error)
		print_r($error);
	else
		header("Location: http://localhost:8080/camagru/");
}

?>