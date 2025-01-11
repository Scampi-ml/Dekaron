<?php

if ($totalpolls > 0) {

	if (!isset ($_REQUEST['option']) && !isset ($_REQUEST['results']) && $votecookies != 'no' && $voteip != 'no' && $blocked != 'yes' && $started == 'yes' && $expired == 'no' && $polls['voting'] == 'yes') {
	
		$poll = mysql_fetch_array (mysql_query ("SELECT pollid, title, voting, results, graph FROM polls WHERE pollid='$whatpoll'"));

		$option = mysql_query ("SELECT optionid, options, order_id FROM options WHERE pollid='$whatpoll' ORDER BY order_id ASC");
	
?>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" name="frmPoll">
<table width="22%" border="0" cellspacing="0" cellpadding="2" class="border">
	<tr bgcolor="#0099FF" class="text">
		<td height="25" colspan="2" align="center"><b><?= $poll['title']; ?></b></td>
	</tr>
	<?php while ($optionrows = mysql_fetch_array ($option)) { ?>
	<tr class="text">
		<td width="10%" align="center" height="25"><input name="option" type="radio" value="<?= $optionrows['optionid']; ?>"<?php if ($optionrows['order_id'] == 1) { echo " CHECKED"; } ?>></td>
		<td width="90%"><?= $optionrows['options']; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="2" align="center" height="25"><input name="stage" type="hidden" value="2"><input name="poll" type="hidden" value="<?= $poll['pollid']; ?>"><input name="btnVote" type="submit" value="Vote" class="text">
		<?php if ($poll['results'] == 'yes' && $poll['graph'] == 'yes') { ?><br><a href="<?= $_SERVER['PHP_SELF']; ?>?poll=<?= $whatpoll; ?>&results=1" class="text">View Results</a><?php } ?></td>
	</tr>
</table>
</form>
<?php
	
	}

	$poll = mysql_fetch_array (mysql_query ("SELECT pollid, title, voting, results, graph, resultsvotes FROM polls WHERE pollid='$whatpoll'"));
		
		if (($blocked == 'yes' | $voteip == 'no' | $votecookies == 'no' | isset ($_REQUEST['results']) | $poll['voting'] == 'no' | isset ($_REQUEST['option'])) && $poll['graph'] == 'yes' && $started == 'yes') {
		
			if (((isset ($_REQUEST['results']) && $poll['results'] == 'yes' && ($voteip != 'yes' | $votecookies != 'yes')) | !isset ($_REQUEST['results'])) && $started == 'yes') {
			
				$option = mysql_query ("SELECT options, votes, images, order_id FROM options WHERE pollid='$whatpoll' ORDER BY order_id ASC");
				$total = mysql_fetch_assoc (mysql_query ("SELECT SUM(votes) AS total FROM options WHERE pollid='$whatpoll'"));

?>
<link href="css/css.css" rel="stylesheet" type="text/css">
<table width="22%" border="0" cellspacing="0" cellpadding="2" class="border">
	<tr class="text">
		<td height="25" colspan="2" align="center" bgcolor="#0099FF"><b><?= $poll['title']; ?></b></td>
	</tr>
	<?php 
	
	while ($optionrows = mysql_fetch_array ($option)) {
	
		@$percent = round (($optionrows['votes'] / $total['total']) * 100);
	
		if ($optionrows['images'] == 'random') {
					
			if ($handle = opendir ($dir2)) {
				  
				while (false !== ($file = readdir ($handle))) {
														
					if ($file != '.' && $file != '..') {
									
						$files[] = $file;
									
					}				
									
				}
								
				shuffle ($files);
							
			}
							
			$rand = rand (0, (count ($files) - 1));
							
			$optionrows['images'] = $files[$rand];
							
		}
	
?>
	<tr class="text">
		<td width="10%" height="25"><?= $optionrows['options']; ?> - <b><?= $percent; ?>%</b><?php if ($poll['resultsvotes'] == "yes") { echo " / ".$optionrows['votes']." Votes"; } ?></td>
	</tr>
	<tr class="text">
		<td width="10%" height="25"><img src="<?= $dir2; ?>/<?= $optionrows['images']; ?>" width="<?= ($percent * $width) + 10; ?>" height="<?= $height; ?>" alt="<?= $optionrows['options']; ?>"></td>
	</tr>
	<?php } ?>
	<tr class="text">
		<td height="25" align="center"><?php if ($poll['resultsvotes'] == "yes") { ?><b>Total Votes: <?= $total['total']; ?></b><?php } if (isset ($_REQUEST['results'])) {?><br><a href="<?= $_SERVER['PHP_SELF']; ?>?poll=<?= $whatpoll; ?>" class="text">Vote On Poll</a><?php } ?></td>
	</tr>
</table>
<?php

		}

	}

} else {

?>
<div align="center" class="text"><b>Error:</b> There are currently no polls. Please <a href="admin/index.php" class="text">create</a> one.</div>
<?php } if ($totalpolls > 0 && $poll['voting'] == 'no' && $poll['graph'] == 'no') { ?>
<div align="center" class="text">Sorry you cannot vote or view results on this poll.</div>
<?php } if ($totalpolls > 0 && $poll['voting'] == 'yes' && $poll['graph'] == 'no' && isset ($_REQUEST['option'])) { ?>
<div align="center" class="text">Thanks for voting on the poll.</div>
<?php } if ($totalpolls > 0 && $poll['voting'] == 'yes' && $poll['graph'] == 'no' && ($voteip == 'no' | $votecookies == 'no') && !isset ($_REQUEST['option'])) { ?>
<div align="center" class="text">Sorry, you cannot view the results for poll <b><?= $polls['title']; ?></b></div>
<?php } if ($totalpolls > 0 && $poll['results'] == 'no' && isset ($_REQUEST['results'])) { ?>
<div align="center" class="text">Sorry, you cannot view the results for poll <b><?= $polls['title']; ?></b></div>
<?php } ?>