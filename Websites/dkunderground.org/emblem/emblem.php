<?
$cemblem=$_GET['cemblem'];
$cbg=$_GET['cbg'];

$output = ImageCreateTrueColor("40", "40");
imagesavealpha($output, true);
$black = imagecolorallocate($output, 0, 0, 0);
imagefill($output, 0, 0, $black);

if($cbg!="empty") {
	$filenum=floor($cbg/144)+1;
	$infilenum=$cbg%144;
	$line=floor($infilenum/12);
	$col=$infilenum%12;
	$bgxoffset=$col*40;
	$bgyoffset=$line*40;
	$bg = ImageCreateFromPNG("guild_bg_".$filenum.".png");
	imagesavealpha($bg, true);
	imagecopyresampled($output, $bg, 0, 0, $bgxoffset, $bgyoffset, "40", "40", "40", "40");
	imagedestroy($bg);
}

if($cemblem!="empty") {
	$filenum=floor($cemblem/144)+1;
	$infilenum=$cemblem%144;
	$line=floor($infilenum/12);
	$col=$infilenum%12;
	$xoffset=$col*40;
	$yoffset=$line*40;
	$emblem = ImageCreateFromPNG("guild_icon_".$filenum.".png");
	imagesavealpha($emblem, true);
	imagecopyresampled($output, $emblem, 0, 0, $xoffset, $yoffset, "40", "40", "40", "40");
	

}

Header( "Content-type: image/png");
Header("Content-Disposition: inline; filename=emblem.png");
imagepng($output,null,0);

?>
