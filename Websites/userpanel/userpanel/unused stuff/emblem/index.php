<?php

$bg_strip=$_GET['bg_strip'];
if($bg_strip=="") $bg_strip=0;

$emblem_strip=$_GET['emblem_strip'];
if($emblem_strip=="") $emblem_strip=0;

$cemblem=$_GET['cemblem'];
if($cemblem=="") $cemblem="empty";

$cbg=$_GET['cbg'];
if($cbg=="") $cbg="empty";

?>
<html>
<head>
</head>
<body bgcolor="#FFFFFF">

<table border="0" cellspacing="0" cellpadding="0" align=center>
<tr><td><img src="top.jpg"></td></tr>
<tr><td><img src="topleft.jpg"><img src="emblem.php?cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>" valign=middle><img src="topright.jpg"></td></tr>

<tr><td><img src="bgleft.jpg"><?php

// navigation left
if($bg_strip>0) {
	?><a href="?bg_strip=<?php echo $bg_strip-1; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="bg_arrowleft.jpg" border=0></a><?php
} else { 
	?><a href="?bg_strip=<?php echo $bg_strip; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="bg_arrowleft.jpg" border=0></a><?php
}
?><img src="bg_title.jpg"><?php

// navigation right
if($bg_strip<3) {
	?><a href="?bg_strip=<?php echo $bg_strip+1; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="bg_arrowright.jpg" border=0></a><?php
} else {
	?><a href="?bg_strip=<?php echo $bg_strip; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="bg_arrowright.jpg" border=0></a><?php
}
?><img src="bgright.jpg"></td></tr>

<tr><td><img src="bg_borderleft.jpg"><img src="bg_strip.php?bg_strip=<?php echo $bg_strip; ?>" usemap="#bg" border="0"><img src="bg_borderright.jpg"></td></tr>

<tr><td><img src="emblemleft.jpg"><?php

//navigation left
if($emblem_strip>0) {
	?><a href="?emblem_strip=<?php echo $emblem_strip-1; ?>&bg_strip=<?php echo $bg_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="emblem_arrowleft.jpg" border=0></a><?php
} else {
	?><a href="?emblem_strip=<?php echo $emblem_strip; ?>&bg_strip=<?php echo $bg_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="emblem_arrowleft.jpg" border=0></a><?php
}

?><img src="emblem_title.jpg"><?php

// navigation right
if($emblem_strip<9) { 
	?><a href="?emblem_strip=<?php echo $emblem_strip+1; ?>&bg_strip=<?php echo $bg_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="emblem_arrowright.jpg" border=0></a><?php
} else {		
	?><a href="?emblem_strip=<?php echo $emblem_strip; ?>&bg_strip=<?php echo $bg_strip; ?>&cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="emblem_arrowright.jpg" border=0></a><?php
}

?><img src="emblemright.jpg"></td></tr>

<tr><td><img src="emblem_borderleft.jpg"><img src="emblem_strip.php?emblem_strip=<?php echo $emblem_strip; ?>" usemap="#emblem" border="0"><img src="emblem_borderright.jpg"></td></tr>

<tr><td><a href="save.php?cbg=<?php echo $cbg; ?>&cemblem=<?php echo $cemblem; ?>"><img src="bottom.jpg" border="0"></a></td></tr>
</table>

<map name="bg">
<?php for($i=0;$i<3;$i++) {
	for($j=0;$j<21;$j++) {
		$bg=$i*21+$j+($bg_strip*63);
		$x1=$j*24;
		$y1=$i*24;
		$x2=$x1+24;
		$y2=$y1+24;
		if($bg<221) {
			?><area shape="rect" coords="<?php echo "$x1,$y1,$x2,$y2"; ?>" href="?bg_strip=<?php echo $bg_strip; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cemblem=<?php echo $cemblem; ?>&cbg=<?php echo $bg; ?>"><?php
		}
	}
}
?>
</map>

<map name="emblem">
<?php for($i=0;$i<3;$i++) {
	for($j=0;$j<21;$j++) {
		$emblem=$i*21+$j+($emblem_strip*63);
		$x1=$j*24;
		$y1=$i*24;
		$x2=$x1+24;
		$y2=$y1+24;
		if($emblem<627) {
			?><area shape="rect" coords="<?php echo "$x1,$y1,$x2,$y2"; ?>" href="?bg_strip=<?php echo $bg_strip; ?>&emblem_strip=<?php echo $emblem_strip; ?>&cemblem=<?php echo $emblem; ?>&cbg=<?php echo $cbg; ?>"><?php
		}
	}
}
?>
</map>
</body>
</html>