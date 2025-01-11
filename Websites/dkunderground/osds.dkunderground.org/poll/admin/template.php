<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr class="text">
		<td width="20%" height="25" align="center" <?php if ($page == 'polls' | $page == 'polls_index') { echo "bgcolor=\"#CCCCCC\" class=\"border\""; ?><a href="index.php" class="text">Polls</a><?php } else { echo "bgcolor=\"#0099FF\""; ?>><a href="../index.php" class="text">Polls</a><?php } ?></td>
	    <td width="20%" align="center" <?php if ($page == 'ipblocker') { echo "bgcolor=\"#CCCCCC\" class=\"border\""; ?><a href="index.php" class="text">IP Blocker</a><?php } else { echo "bgcolor=\"#0099FF\""; ?>><a href="<?php if ($page == 'images') {?>../<?php } ?>ip/index.php" class="text">IP Blocker</a><?php } ?></td>
	    <td width="20%" align="center" <?php if ($page == 'images') { echo "bgcolor=\"#CCCCCC\" class=\"border\""; ?><a href="index.php" class="text">Images</a><?php } else { echo "bgcolor=\"#0099FF\""; ?>><a href="<?php if ($page == 'ipblocker') {?>../<?php } ?>images/index.php" class="text">Images</a><?php } ?></td>
	    <td width="40%">&nbsp;</td>
	</tr>
	<?php if ($page == 'polls_index') { ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<?php
				
					@include ("../config.php");
				
					$numrows = mysql_num_rows (mysql_query ("SELECT pollid FROM polls"));
					
					?>
					<td height="25" width="100%" align="center"><b>Number of Polls:</b> <?= $numrows; ?> | <a href="add.php" class="text">Create A Poll</a><?php if ($numrows > 0) { ?> | <a href="empty.php" class="text">Delete All Polls</a><?php } ?></td>
				</tr>
			</table>
			<br>
		</td>
	</tr>
	<?php } ?>
</table>