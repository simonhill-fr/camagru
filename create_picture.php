<?php

function create_picture($filter_source){
	// Get the img and decode it
	$img = $_POST['img_data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

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

	//$db = db_connection();
	$sql = "
		INSERT INTO pictures (id, user_id, timestamp, path)
		VALUES ('0', '".$_SESSION['user_id']."', '".time()."', '".$filePath."')
		";

	if (!db_execute($sql, NULL))
		echo "db error";
	
	}

?>
