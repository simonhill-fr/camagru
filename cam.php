<?php

$img = $_POST['frr'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
//	$fileName = 'photo.png';
//	file_put_contents($fileName, $fileData);

// Charge le cachet et la photo afin d'y appliquer le tatouage numérique
$stamp = imagecreatefrompng('./images/filters/wig.png');
$bottom = imagecreatefromstring($fileData);

// Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci
$bottom_width = imagesx($bottom);
$bottom_height = imagesy($bottom);

//resize stamp to fit bottom
$stamp_resize = imagecreate($bottom_width, $bottom_height);
$stamp_width = imagesx($stamp);
$stamp_height = imagesy($stamp);
imagecopyresized($stamp_resize, $stamp, 0, 0, 0, 0, $bottom_width, $bottom_height, $stamp_width, $stamp_height);

// Copie stamp on bottom layer
imagecopy($bottom, $stamp_resize, 0, 0, 0, 0, $bottom_width, $bottom_height);

// Affichage et libération de la mémoire
imagepng($bottom, "out.png");
//imagedestroy($im);

$display_img = "<img src='out.png'>";

?>
