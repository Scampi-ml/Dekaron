<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Polls</title>
<link href="../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<?php $page = 'polls_index'; @include ("template.php"); ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
			<?php if ($numrows > 0) { ?>
				<tr class="text" bgcolor="#0099FF">
					<td width="5%" height="25" align="center" bgcolor="#0099FF"><b>ID</b></td>
					<td width="10%" align="center" bgcolor="#0099FF"><b>Created</b></td>
					<td align="center" width="55%"><b>Title</b></td>
					<td width="10%" align="center" bgcolor="#0099FF"><b>Status</b></td>
					<td width="20%" align="center" bgcolor="#0099FF"><b>Change</b></td>
				</tr>
				<?php
				
					$result = mysql_query ("SELECT pollid, title, subdate, status FROM polls ORDER BY pollid ASC");
					
					while ($myrow = mysql_fetch_array ($result)) {
					
				?>
				<tr class="text">
					<td height="25" align="center"><?= $myrow['pollid']; ?></td>
					<td align="center"><?= $myrow['subdate']; ?></td>
					<td align="center"><?= substr ($myrow['title'], 0, 50); ?> ...</td>
					<td align="center"><?= ucfirst ($myrow['status']); ?></td>
					<td align="center"><a href="edit.php?poll=<?= $myrow['pollid']; ?>" class="text">Edit</a> | <a href="delete.php?poll=<?= $myrow['pollid']; ?>" class="text">Delete</a> | <a href="view.php?poll=<?= $myrow['pollid']; ?>" class="text">View</a></td>
				</tr>
				<?php 
				
					} 
				
				} else {
				
				?>
				<tr class="text">
					<td height="25" align="center" colspan="5">There are currently no polls. Please create one.</td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>
</body>
</html>