<?php
session_start();
if (isset($_SESSION["user"])){
	$_SESSION["user"] = "";
	$_SESSION["user_id"] = "";
}
header("Location: ./");
?>