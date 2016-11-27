<?php

$string = "text";
$im     = imagecreatefrompng("images/camera-flat.png");
$orange = imagecolorallocate($im, 220, 210, 60);
$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
imagestring($im, 3, $px, 9, $string, $orange);
imagepng($im, "out.png");

imagedestroy($im);

?>
<img src="out.png">