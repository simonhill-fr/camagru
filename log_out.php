<?php
session_start();
include 'error_report.php';
if (isset($_SESSION["user"])){
	$_SESSION["user"] = "";
	$_SESSION["user_id"] = "";
}
header("Location: ./");
?>