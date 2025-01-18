<?php


$varY = $_GET['axisy']; // Vertical
$varX = $_GET['axisx']; // horizontal
$current = "images/pointcurrent.png";


$map = exo_getglobalvariable('HEPublicationPath', '').'Data/'.$_GET['map'] ;	

//------------------------------------------
	
$src = imagecreatefrompng($current);
$dest = imagecreatefrompng($map);

imagealphablending($dest, true);
imagesavealpha($dest, true);

// Copy and merge
imagecopymerge($dest, $src, $varX, $varY, 0, 0, 20, 20, 100);



// Output and free from memory
header('Content-Type: image/png');
imagepng($dest);

imagedestroy($dest);
imagedestroy($src);


?>