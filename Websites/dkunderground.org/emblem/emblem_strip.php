<?
$offset=0;
$emblem_strip=$_GET['emblem_strip'];

if($emblem_strip!="" && $emblem_strip<7) {
	$offset=$emblem_strip*72;
	$emblem_file="guild_icon_s1.jpg";
} elseif ($emblem_strip!="" && $emblem_strip>6) {
	$offset=($emblem_strip-7)*72;
	$emblem_file="guild_icon_s2.jpg";
}


$Originalgrafik = ImageCreateFromJPEG($emblem_file);
$Grafik = ImageCreateTrueColor("504", "72");
imagecopyresampled($Grafik, $Originalgrafik, 0, 0, 0, $offset, "504", "72", "504", "72");
Header( "Content-type: image/jpeg");
Header("Content-Disposition: inline; filename=emblem_strip.jpg");
imagejpeg($Grafik,null,100);
?>