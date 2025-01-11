<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | IP Blocker</title>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
				
@include ("../../config.php");
				
$numrows = mysql_num_rows (mysql_query ("SELECT blockedid FROM blocked"));
$numrows_polls = mysql_num_rows (mysql_query ("SELECT pollid FROM polls"));

?>					
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'ipblocker'; @include ("../template.php"); ?>
	<tr>
		<td colspan="4">
			<?php if ($numrows_polls > 0) { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td height="25" width="100%" align="center"><b>Number of Blocked IP's:</b> <?= $numrows; ?> | <a href="add.php" class="text">Create A Block</a><?php if ($numrows > 0) { ?> | <a href="empty.php" class="text">Delete All Blocks</a><?php } ?></td>
				</tr>
			</table>
			<br>
			<?php } ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
			<?php if ($numrows > 0 && $numrows_polls > 0) { ?>
				<tr class="text" bgcolor="#0099FF">
					<td width="5%" height="25" align="center" bgcolor="#0099FF"><b>ID</b></td>
					<td width="20%" align="center" bgcolor="#0099FF"><b>IP Address</b></td>
					<td width="55%" align="center"><b>Blocked Polls</b></td>
					<td width="20%" align="center" bgcolor="#0099FF"><b>Change</b></td>
				</tr>
				<?php
				
					$result = mysql_query ("SELECT * FROM blocked ORDER BY blockedid ASC");
					
					while ($myrow = mysql_fetch_array ($result)) {
					
				?>
				<tr class="text">
					<td height="25" align="center"><?= $myrow['blockedid']; ?></td>
					<td align="center"><?= $myrow['ip']; ?></td>
					<td align="center"><?php if ($myrow['polls'] == 'all;') { echo "All Polls"; } else { echo substr ($myrow['polls'], 0, 85); } ?> ...</td>
					<td align="center"><a href="edit.php?poll=<?= $myrow['blockedid']; ?>" class="text">Edit</a> | <a href="delete.php?poll=<?= $myrow['blockedid']; ?>" class="text">Delete</a> | <a href="view.php?poll=<?= $myrow['blockedid']; ?>" class="text">View</a></td>
				</tr>
				<?php 
				
					} 
				
				}
				
				if ($numrows == 0 && $numrows_polls > 0) {
				
				?>
				<tr class="text">
					<td height="25" align="center" colspan="4">There are currently no blocks. Please create one.</td>
				</tr>
				<?php } if ($numrows_polls == 0) { ?>
				<tr class="text">
					<td height="25" align="center" colspan="4">There are currently no polls so no blocks can be created. Please create a poll.</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>