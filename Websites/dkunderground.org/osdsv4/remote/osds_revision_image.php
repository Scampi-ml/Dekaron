<?php


$url = 'http://osds.googlecode.com/svn/';
require_once("phpsvnclient.php");

$phpsvnclient = new phpsvnclient($url);

	
	
$version = $phpsvnclient->getFileVersion('/trunk/');
	



$my_img = imagecreate( 300, 30 );
$background = imagecolorallocate( $my_img, 255, 255, 255 );
$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
imagestring( $my_img, 50, 5, 5, "Current OSDS V4 Revision: " . $version, $text_colour );

header( "Content-type: image/png" );
imagepng( $my_img );
imagecolordeallocate( $text_color );
imagecolortransparent( $background );
imagedestroy( $my_img );


?>
