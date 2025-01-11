<?php
$offset=0;
$bg_strip=$_GET['bg_strip'];
if($bg_strip!="") $offset=$bg_strip*72;
$Originalgrafik = ImageCreateFromJPEG("guild_bg_s1.jpg");
$Grafik = ImageCreateTrueColor("504", "72");
imagecopyresampled($Grafik, $Originalgrafik, 0, 0, 0, $offset, "504", "72", "504", "72");
Header( "Content-type: image/jpeg");
Header("Content-Disposition: inline; filename=bg_strip.jpg");
imagejpeg($Grafik,null,100);
?>