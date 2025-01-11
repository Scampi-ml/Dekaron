<?php
header("Content-type: image/png"); 

$x = $_GET['x'];
$y = $_GET['y'];
$map = 'maps/'.$_GET['map'];
$color = $_GET['color'];
$pointer = $_GET['pointer'];

$im = imagecreatefrompng($map);	

if($color == 'GREEN')
{
	$pointer_color = imagecolorallocate($im, 0, 255, 0); // colors GREEN
}
elseif($color == 'BLUE')
{
	$pointer_color = imagecolorallocate($im, 0, 0, 255); // colors BLUE
}
elseif($color == 'RED')
{
	$pointer_color = imagecolorallocate($im, 255, 0, 250); // colors RED
}
elseif($color == 'YELLOW')
{
	$pointer_color = imagecolorallocate($im, 255, 255, 0); // colors YELLOW
}
else
{
	$pointer_color = imagecolorallocate($im, 255, 250, 250);
}




imagestring($im, 10, $x, $y, $pointer, $pointer_color);
imagepng($im); 
imagedestroy($im); 
?>