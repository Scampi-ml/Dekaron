<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Polls > View A Poll</title>
<link href="../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'polls'; @include ("template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">Polls</a> > <b>View A Poll</b></td>
				</tr>
			</table>
			<br>
			<?php 
			
			function view () { 
			
				include ("../config.php");
				
				$polls = mysql_fetch_array (mysql_query ("SELECT * FROM polls WHERE pollid='$_REQUEST[poll]'"));
				
				$years = floor ($polls['vote'] / 31557600);
				$months = floor (($polls['vote'] - ($years * 31557600)) / 2629800);
				$days = floor (($polls['vote'] - (($years * 31557600) + ($months * 2629800))) / 86400);
				$hours = floor (($polls['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400))) / 3600);
				$minutes = floor (($polls['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400) + ($hours * 3600))) / 60);
				$seconds = floor (($polls['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400) + ($hours * 3600) + ($minutes * 60))));
			
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Pollid:</b></td>
					<td width="75%" colspan="4" align="center"><?= $polls['pollid']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Poll Created:</b></td>
					<td width="75%" colspan="4" align="center"><?= $polls['subdate']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" height="25" colspan="5">&nbsp;</td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Title:</b></td>
					<td width="75%" colspan="4" align="center"><?= $polls['title']; ?></td>
				</tr>
				<?php
				
				$sum = mysql_fetch_assoc (mysql_query ("SELECT SUM(votes) AS total FROM options WHERE pollid='$_REQUEST[poll]'"));
				
				$result = mysql_query ("SELECT optionid, options, images, votes, order_id FROM options WHERE pollid='$_REQUEST[poll]' ORDER BY order_id ASC");
				
				while ($options = mysql_fetch_array ($result)) {
				
					$percent = @round (($options['votes'] / $sum['total']) * 100);
					
					if ($options['images'] == 'random') {
					
						if ($handle = opendir ($dir)) {
			  
							while (false !== ($file = readdir ($handle))) {
													
								if ($file != '.' && $file != '..') {
								
									$files[] = $file;
								
								}				
								
							}
							
							shuffle ($files);
						}
						
						$rand = rand (0, (count ($files) - 1));
						
						$options['images'] = $files[$rand];
						
					}
				
				?>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Option <?= $options['order_id']; ?>:</b></td>
					<td width="37%" align="right">(optionid = <?= $options['optionid']; ?>) <?= $options['options']; ?> </td>
					<td width="25%" align="left" bgcolor="#CCCCCC"><img src="<?= $dir; ?>/<?= $options['images']; ?>" width="<?= ($percent * 2) + 10; ?>" height="17" alt="<?= $options['options']; ?>"></td>
					<td width="4%" align="left"><?= $percent ?>%</td>
					<td width="9%" align="left"><?= $options['votes']; ?> Votes</td>
				</tr>
				<?php } ?>
				<tr class="text">
					<td width="92%" height="25" colspan="4">&nbsp;</td>
					<td width="8%" align="left"><b><?= $sum['total']; ?> Votes</b></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Poll Starts:</b></td>
					<td width="75%" colspan="4" align="center"><?= $polls['starts']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Poll Expires:</b></td>
					<td width="75%" colspan="4" align="center"><?= $polls['expires']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>User Can Vote:</b></td>
					<td width="75%" colspan="4" align="center">Years: <?= $years; ?> | Months: <?= $months; ?> | Days: <?= $days; ?> | Hours: <?= $hours; ?> | Minutes: <?= $minutes; ?> | Seconds: <?= $seconds; ?></td>
				</tr>
				<tr class="text">
					<td align="right" height="25"><b>Enable Voting:</b></td>
					<td colspan="4" align="center"><?= ucfirst ($polls['voting']); ?></td>
				</tr>
				<tr class="text">
					<td align="right" height="25"><b>Enable Results:</b></td>
					<td colspan="4" align="center"><?= ucfirst ($polls['graph']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>See Results Before Voting:</b></td>
					<td width="75%" colspan="4" align="center"><?= ucfirst ($polls['results']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>See Votes In Results:</b></td>
					<td width="75%" colspan="4" align="center"><?= ucfirst ($polls['resultsvotes']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Use IP Protection:</b></td>
					<td width="75%" colspan="4" align="center"><?= ucfirst ($polls['ip']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Use Cookie Protection:</b></td>
					<td width="75%" colspan="4" align="center"><?= ucfirst ($polls['cookies']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Status:</b></td>
					<td width="75%" colspan="4" align="center"><?= ucfirst ($polls['status']); ?></td>
				</tr>
				<tr class="text">
					<td width="25%" height="25" colspan="5">&nbsp;</td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25" valign="top"><b>Blocked IP Addresses:</b></td>
					<td width="75%" colspan="4" align="center">
						<?php
							
						$result = mysql_query ("SELECT ip FROM blocked WHERE polls LIKE '%$polls[title]%'");
						$numrows = mysql_num_rows ($result);
							
						if ($numrows > 0) {
							
							while ($blocked = mysql_fetch_array ($result)) {
							
								echo $blocked['ip']."<br>";
									
							}
								
						} else {
							
							echo "None";
								
						}
							
						?>
					</td>
				</tr>
			</table>
			<br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text"><< Back to the Admin Area</a></td>
				</tr>
			</table>
			<?php
			
			}
			
			view ();
			
			?>
		</td>
	</tr>
</table>
</body>
</html>