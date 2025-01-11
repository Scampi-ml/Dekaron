<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Images > Delete All Images</title>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'images'; @include ("../template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">Images</a> > <b>Delete All Images</b></td>
				</tr>
			</table>
			<br>
			<?php function complete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=index.php"><b>Success:</b> All Images have been deleted</td>
				</tr>
			</table>
			<br>
			<?php } function ask () { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr align="center" class="text">
					<td height="25" colspan="2">Are you sure you wish to delete all images?</td>
				</tr>
				<tr class="text">
					<td width="50%" height="25" align="center">
						<form action="empty.php" method="post" name="frmEmpty">
						<input name="stage" type="hidden" value="2">
						<input name="btnSubmit" type="submit" class="text" value="Yes, delete them!">
						</form>
					</td>
					<td width="50%" align="center">
						<form action="index.php" method="get" name="frmSave">
						<input name="btnSubmit" type="submit" class="text" value="No, save them!">
						</form>
					</td>
				</tr>
			</table>
			<?php
			
			}
			
			if (isset ($_REQUEST['stage'])) {
			
				include ("../../config.php");
			
				if ($handle = opendir ("../".$dir)) {
			  
					while (false !== ($file = readdir ($handle))) {
																	
						if ($file != '.' && $file != '..') {
												
							$files[] = $file;
												
						}	
												
					}
					
				}
			
				for ($i = 0;$i < count ($files);$i++) {
				
					unlink ("../".$dir."/".$files[$i]);
					
				}
			
				complete ();
				
			} else {
			
				ask ();
				
			}
			
			?>
		</td>
	</tr>
</table>
</body>
</html>