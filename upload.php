<?php

function create_fly_picture($fileData, $filter_source){
	
	// Load the stamp layer and bottom layer
	$stamp = imagecreatefrompng($filter_source);
	$bottom = imagecreatefromstring($fileData);

	// Get width and height of bottom layer
	$bottom_width = imagesx($bottom);
	$bottom_height = imagesy($bottom);

	// Copy stamp on bottom layer
	imagecopy($bottom, $stamp, 0, 0, 0, 0, $bottom_width, $bottom_height);

	// Store in disk and database
	$filePath = "./user_img/". $_SESSION['user_id'] . "/" . uniqid() . ".png";
	imagepng($bottom, $filePath);
	imagedestroy($bottom);

	$db = db_connection();
	$sql = "INSERT INTO pictures 
	VALUES ('0', '".$_SESSION['user_id']."', '".time()."', '".$filePath."')";

	if ($db->exec($sql))
	{}
	else
		echo "db error";
	
	}


$imageFileType = pathinfo($_FILES["imgToUpload"]["name"], PATHINFO_EXTENSION);
$target_dir = "uploads/";
$target_file = $target_dir . uniqid() . "." . $imageFileType;
$uploadOk = 1;

if (isset($_POST["upload_submit"]))
{
	$error = array();
	if (!($check = getimagesize($_FILES["imgToUpload"]["tmp_name"])));
		array_push($error, "File is not an image");
}

//	check if file exists 
if (file_exists($target_file))
{
	echo "File exists";
	$uploadOk = 0;
}
//	check file size
if ($_FILES["imgToUpload"]["size"] > 500000)
{
	$uploadOk = 0;
	echo "File too large";
}
//file format
if ($imageFileType != "jpg" && $imageFileType != "jpeg" 
	&& $imageFileType != "png" && $imageFileType != "gif")
{
	$uploadOk = 0;
	echo "Wrong type";
}
if ($uploadOk)
{
	$fileData = $_FILES["imgToUpload"]["tmp_name"];


}











