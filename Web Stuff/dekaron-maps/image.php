<?php
header("Content-type: image/png"); 

$string = $_POST['string'];
$r = $_POST['r'];
$g = $_POST['g'];
$b = $_POST['b'];
$varY = $_POST['axisy']; // Vertical
$varX = $_POST['axisx']; // horizontal

$map = "png/" . $_POST['map'];


    $im     = imagecreatefrompng($map); // the map
    $color = imagecolorallocate($im, $r, $g, $b); // colors
    imagestring($im, 10, $varX, $varY, $string, $color); 
    imagepng($im); 
    imagedestroy($im); 


?>