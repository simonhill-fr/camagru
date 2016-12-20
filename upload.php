<?php
session_start();
require_once "model/db_query.php";

function create_fly_picture($fileData, $filter_source){
	
	// Load the stamp layer and bottom layer
	$stamp = imagecreatefrompng($filter_source);
	$bottom = imagecreatefrompng($fileData);

	// Get width and height of bottom layer
	$bottom_width = imagesx($stamp);
	$bottom_height = imagesy($stamp);

	// Copy stamp on bottom layer
	imagecopy($bottom, $stamp, 0, 0, 0, 0, $bottom_width, $bottom_height);

	// Store in disk and database
	$filePath = "./user_img/". $_SESSION['user_id'] . "/" . uniqid() . ".png";
	imagepng($bottom, $filePath);
	imagedestroy($bottom);

	$db = db_connection();
	$sql = "INSERT INTO pictures (id, user_id, timestamp, path)
	VALUES ('0', '".$_SESSION['user_id']."', '".time()."', '".$filePath."')";

	if ($db->exec($sql))
		return true;
	else
		return false;	
}

$imageFileType = pathinfo($_FILES["imgToUpload"]["name"], PATHINFO_EXTENSION);
$target_dir = "uploads/";
$target_file = $target_dir . uniqid() . "." . $imageFileType;

$error = array();
if (isset($_POST["upload_submit"])
	&& isset($_FILES["imgToUpload"]["tmp_name"])
	&& !empty($_FILES["imgToUpload"]["tmp_name"]) 
	&& isset($_POST["upload_filter"])
	&& !empty($_POST["upload_filter"]))
{
	$check = getimagesize($_FILES["imgToUpload"]["tmp_name"]);
	if ($check === false)
		array_push($error, "File is not an image");
	$check = getimagesize($_POST["upload_filter"]);
	if ($check === false)
		array_push($error, "Filter is not an image");
}
else
	array_push($error, "Please fill all the fields");

//	check if file exists 
if (file_exists($target_file))
{
	array_push($error, "File exists");
}
//	check file size
if ($_FILES["imgToUpload"]["size"] > 500000)
{
	array_push($error, "File too large");
}
//file format
if ($imageFileType != "jpg" && $imageFileType != "jpeg" 
	&& $imageFileType != "png" && $imageFileType != "gif")
{
	array_push($error, "Wrong type");
}
if (!$error)
{
	$fileData = $_FILES["imgToUpload"]["tmp_name"];
	if (!create_fly_picture($fileData, $_POST["upload_filter"]))
		array_push($error, "Error editing");
}
if ($error)
{
	$_SESSION["error"] = $error[0];
}

header("Location: http://localhost:8080/camagru/?page=create");



?>








