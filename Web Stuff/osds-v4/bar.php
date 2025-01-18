<?php

// this bar file is for server info block
error_reporting(0);
function drawRating()
{
	// get hight and width
   $width = $_GET['width'];
   $height = $_GET['height'];
   
   
   // if hight and width are not set, set to defaults
   if ($width == 0) {
     $width = 200;
   }
   
   if ($height == 0) {
     $height = 7;
   }
   
   // get rating
   $rating = $_GET['rating'];
   
   
   $ratingbar = (($rating/100)*$width)-2;
   $image = imagecreate($width,$height);
   $fill = ImageColorAllocate($image,0,255,0);  // green
   
   // let make things pretty, change color if % is higher then ...
   if ($rating > 49) { $fill = ImageColorAllocate($image,255,255,0); } // orange
   if ($rating > 74) { $fill = ImageColorAllocate($image,255,128,0); } // yellow
   if ($rating > 89) { $fill = ImageColorAllocate($image,255,0,0); } // red
   
   
   $back = ImageColorAllocate($image,205,205,205);
   $border = ImageColorAllocate($image,0,0,0);
   ImageFilledRectangle($image,0,0,$width-1,$height-1,$back);
   ImageFilledRectangle($image,1,1,$ratingbar,$height-1,$fill);
   ImageRectangle($image,0,0,$width-1,$height-1,$border);
   imagePNG($image);
   imagedestroy($image);
}
Header("Content-type: image/png");
drawRating();
?>