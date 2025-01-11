<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Polls > Delete A Poll</title>
<link href="../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'polls'; @include ("template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">Polls</a> > <b>Delete A Poll</b></td>
				</tr>
			</table>
			<br>
			<?php function complete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=index.php"><b>Success:</b> Your poll has been deleted</td>
				</tr>
			</table>
			<br>
			<?php } function ask () { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr align="center" class="text">
					<td height="25" colspan="2">Are you sure you wish to delete poll <b><?= $_REQUEST['poll']; ?></b>?</td>
				</tr>
				<tr class="text">
					<td width="50%" height="25" align="center">
						<form action="delete.php" method="post" name="frmDelete">
						<input name="poll" type="hidden" value="<?= $_REQUEST['poll']; ?>">
						<input name="stage" type="hidden" value="2">
						<input name="btnSubmit" type="submit" class="text" value="Yes, delete it!">
						</form>
					</td>
					<td width="50%" align="center">
						<form action="index.php" method="get" name="frmSave">
						<input name="btnSubmit" type="submit" class="text" value="No, save it!">
						</form>
					</td>
				</tr>
			</table>
			<?php
			
			}
			
			if (isset ($_REQUEST['stage'])) {
			
				include ("../config.php");
				
				$myrow = mysql_fetch_array (mysql_query ("SELECT pollid, title FROM polls WHERE pollid='$_REQUEST[poll]'"));
				
				$results = mysql_query ("SELECT blockedid, polls FROM blocked WHERE polls LIKE '%$myrow[title]%'");
				$numrows = mysql_num_rows ($results);
				
				if ($numrows > 0) {
				
					while ($blockrow = mysql_fetch_array ($results)) {
					
						$polls = ereg_replace ($myrow['title'].";", "", $blockrow['polls']);
						
						mysql_query ("UPDATE blocked SET polls='$polls' WHERE blockedid='$blockrow[blockedid]'");
						
					}
						
					mysql_query ("DELETE FROM blocked WHERE polls=''");
				
				}
				
				mysql_query ("DELETE FROM polls WHERE pollid='$_REQUEST[poll]'");
				mysql_query ("DELETE FROM options WHERE pollid='$_REQUEST[poll]'");		
				mysql_query ("DELETE FROM ip WHERE title='$myrow[title]'");
				
				$pollrows = mysql_num_rows (mysql_query ("SELECT pollid FROM polls"));
				
				if ($pollrows == 0) {
				
					mysql_query ("TRUNCATE blocked");
					mysql_query ("TRUNCATE ip");
					
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