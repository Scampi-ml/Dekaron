<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Images</title>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php

include ("../../config.php");

if ($handle = opendir ("../".$dir)) {
			  
	while (false !== ($file = readdir ($handle))) {
													
		if ($file != '.' && $file != '..') {
								
			$files[] = $file;
								
		}	
								
	}
	
	if (isset ($files)) {
	
		$count = count ($files);
		
	} else {
	
		$count = 0;
		
	}
	
}

?>		
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'images'; @include ("../template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td height="25" width="100%" align="center"><b>Number of Images:</b> <?= $count; ?> | <a href="add.php" class="text">Upload An Image</a><?php if ($count > 0) { ?> | <a href="empty.php" class="text">Delete All Images</a><?php } ?></td>
				</tr>
			</table>
			<br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<?php if ($count > 0) { ?>
				<tr class="text" bgcolor="#0099FF">
					<td width="50%" height="25" align="center" bgcolor="#0099FF"><b>Filename</b></td>
					<td width="30%" align="center" bgcolor="#0099FF"><b>Preview</b></td>
					<td width="20%" align="center" bgcolor="#0099FF"><b>Change</b></td>
				</tr>
				<?php for ($i = 0;$i < $count;$i++) { ?>
				<tr class="text">
					<td height="25" align="center"><?= $files[$i]; ?></td>
					<td align="center"><img src="../<?= $dir; ?>/<?= $files[$i]; ?>" width="<?= 100 * $width; ?>" height="<?= $height; ?>" alt="<?= $files[$i]; ?>" border="0"></td>
					<td align="center"><a href="edit.php?image=<?= $files[$i]; ?>" class="text">Edit</a> | <a href="delete.php?image=<?= $files[$i]; ?>" class="text">Delete</a></td>
				</tr>
				<?php } } else { ?>
				<tr class="text">
					<td height="25" align="center" colspan="4">There are currently no images. Please upload one.</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>