<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Archive</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="border">
	<?php 
	
	@include ("config.php");
	
	$result = mysql_query ("SELECT pollid, title, starts, subdate FROM polls WHERE status='on' AND graph='yes' ORDER BY pollid DESC");
	$numrows = mysql_num_rows ($result);
	
	if (isset ($_REQUEST['poll'])) {
	
		$poll = mysql_fetch_array (mysql_query ("SELECT pollid, title, voting, results, graph, resultsvotes FROM polls WHERE pollid='$_REQUEST[poll]' AND status='on' AND graph='yes'"));
		$option = mysql_query ("SELECT options, votes, images, order_id FROM options WHERE pollid='$_REQUEST[poll]' ORDER BY order_id ASC");
		$total = mysql_fetch_assoc (mysql_query ("SELECT SUM(votes) AS total FROM options WHERE pollid='$_REQUEST[poll]'"));
		
		if (mysql_num_rows (mysql_query ("SELECT pollid FROM polls WHERE pollid='$_REQUEST[poll]'")) == 1) {
	
	?>
	<tr>
		<td align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
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
			<br>
		</td>
	</tr>
	<?php }} if ($numrows == 0) {?>
	<tr class="text">
		<td height="25" align="center"><b>Error:</b> There is currently no archive!</td>
	</tr>
	<?php } else { ?>
	<tr class="text">
		<td height="25" align="center" bgcolor="#0099FF"><b>Previous Polls:</b></td>
	</tr>
	<?php
	
	}
	
	while ($polls = mysql_fetch_array ($result)) {
				
		list ($days, $months, $years) = explode ("/", $polls['starts']);
		$now = mktime (0, 0, 0, date ("m"), date ("d"), date ("Y"));
		$starts = mktime (0, 0, 0, $months, $days, $years);
	
		if ($starts > $now) {
	
			$started = "no";
					
		} else {
	
			$started = "yes";
		
		}
		
		if ($started == 'yes') {
			
	?>
	<tr class="text">
		<td height="25" align="center"><a href="<?= $_SERVER['PHP_SELF'];?>?poll=<?= $polls['pollid']; ?>" class="text"><?= $polls['title']; ?></a> - <?= $polls['subdate']; ?></td>
	</tr>
	<?php }} ?>
</table>
</body>
</html>
