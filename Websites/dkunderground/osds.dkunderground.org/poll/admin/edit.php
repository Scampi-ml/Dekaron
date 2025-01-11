<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Polls > Edit A Poll</title>
<link href="../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'polls'; @include ("template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">Polls</a> > <b>Edit A Poll</b></td>
				</tr>
			</table>
			<br>
			<?php function complete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=index.php"><b>Success:</b> Your poll has been edited</td>
				</tr>
			</table>
			<br>
			<?php 
			
			} 
			
			function poll () { 
			
				include ("../config.php");
				
				$myrow = mysql_fetch_array (mysql_query ("SELECT * FROM polls WHERE pollid='$_REQUEST[poll]'"));
				
				$options = mysql_num_rows (mysql_query ("SELECT optionid FROM options WHERE pollid='$_REQUEST[poll]'"));
				$result = mysql_query ("SELECT optionid, options, images, order_id FROM options WHERE pollid='$_REQUEST[poll]' ORDER BY order_id ASC");
				
				$starts = explode ("/", $myrow['starts']);
				$expires = explode ("/", $myrow['expires']);
				
				$years = floor ($myrow['vote'] / 31557600);
				$months = floor (($myrow['vote'] - ($years * 31557600)) / 2629800);
				$days = floor (($myrow['vote'] - (($years * 31557600) + ($months * 2629800))) / 86400);
				$hours = floor (($myrow['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400))) / 3600);
				$minutes = floor (($myrow['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400) + ($hours * 3600))) / 60);
				$seconds = floor (($myrow['vote'] - (($years * 31557600) + ($months * 2629800) + ($days * 86400) + ($hours * 3600) + ($minutes * 60))));
			
			?>
			<form action="edit.php" method="post" name="frmPoll">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Title:</b></td>
								<td width="75%" colspan="3" align="center"><?= $myrow['title']; ?></td>
							</tr>
							<?php 
							
							for ($i = 1; $i <= $options;$i++ ) { 
								
								$optionsrow = mysql_fetch_array ($result);
							
							?>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Option <?= $optionsrow['order_id']; ?>:</b></td>
								<td align="center" width="45%"><?= $optionsrow['options']; ?></td>
								<td align="center" width="20%">
									<input type="hidden" name="order_id[<?= $i; ?>]" value="<?= $optionsrow['order_id']; ?>">
									<select name="images[<?= $i; ?>]" class="text">
										<option value="random"<?php if (isset ($_REQUEST['images'])) { if ($_REQUEST['images'] == 'random') { echo " SELECTED"; } } else { if ($optionsrow['images'] == 'random') { echo " SELECTED"; } } ?>>Random</option>
									<?php include ("../config.php"); if ($handle = opendir ($dir)) { while (false !== ($file = readdir($handle))) {if ($file != '.' && $file != '..') { ?>
										<option value="<?= $file; ?>"<?php if (isset ($_REQUEST['images'])) { if ($_REQUEST['images'] == $files) { echo " SELECTED"; } } else { if ($optionsrow['images'] == $file) { echo " SELECTED"; } } ?>><?= $file; ?></option>
									<?php } } closedir ($handle);  } ?>
									</select>
								</td>
								<td align="center" width="10%"><?php if ($i != 1) { ?><a href="edit.php?poll=<?= $_REQUEST['poll']; ?>&moveup=<?= $optionsrow['optionid']; ?>"><img src="up.gif" alt="Move Option Up" width="9" height="14" border="0"></a><?php } if ($i != 1 && $i != $options) { ?> | <?php } if ($i != $options) { ?><a href="edit.php?poll=<?= $_REQUEST['poll']; ?>&movedown=<?= $optionsrow['optionid']; ?>"><img src="down.gif" alt="Move Option Down" width="9" height="14" border="0"></a><?php } ?></td>
							</tr>
							<?php } ?>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Starts:</b></td>
								<td width="75%" colspan="3" align="center">
									<select name="startsDays" class="text">
										<?php for ($i = 1;$i <= 31;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>" <?php if (isset ($_REQUEST['startsDays'])) { if ($_REQUEST['startsDays'] == $i) { echo "SELECTED"; } } else { if ($starts[0] == $i) { echo "SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="startsMonths" class="text">
										<?php for ($i = 1;$i <= 12;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>" <?php if (isset ($_REQUEST['startsMonths'])) { if ($_REQUEST['startsMonths'] == $i) { echo "SELECTED"; } } else { if ($starts[1] == $i) { echo "SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="startsYears" class="text">
										<option value="2005" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2005') { echo "SELECTED"; } } else { if ($starts[2] == '2005') { echo "SELECTED"; } } ?>>2005</option>
										<option value="2006" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2006') { echo "SELECTED"; } } else { if ($starts[2] == '2006') { echo "SELECTED"; } } ?>>2006</option>
										<option value="2007" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2007') { echo "SELECTED"; } } else { if ($starts[2] == '2007') { echo "SELECTED"; } } ?>>2007</option>
										<option value="2008" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2008') { echo "SELECTED"; } } else { if ($starts[2] == '2008') { echo "SELECTED"; } } ?>>2008</option>
										<option value="2009" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2009') { echo "SELECTED"; } } else { if ($starts[2] == '2009') { echo "SELECTED"; } } ?>>2009</option>
										<option value="2010" <?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2010') { echo "SELECTED"; } } else { if ($starts[2] == '2010') { echo "SELECTED"; } } ?>>2010</option>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Expires:</b></td>
								<td width="75%" colspan="3" align="center">
									<select name="expiresDays" class="text">
										<?php for ($i = 1;$i <= 31;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>" <?php if (isset ($_REQUEST['expiresDays'])) { if ($_REQUEST['expiresDays'] == $i) { echo "SELECTED"; } } else { if ($expires[0] == $i) { echo "SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="expiresMonths" class="text">
										<?php for ($i = 1;$i <= 12;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>" <?php if (isset ($_REQUEST['expiresMonths'])) { if ($_REQUEST['expiresMonths'] == $i) { echo "SELECTED"; } } else { if ($expires[1] == $i) { echo "SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="expiresYears" class="text">
										<option value="2005" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2005') { echo "SELECTED"; } } else { if ($expires[2] == '2005') { echo "SELECTED"; } } ?>>2005</option>
										<option value="2006" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2006') { echo "SELECTED"; } } else { if ($expires[2] == '2006') { echo "SELECTED"; } } ?>>2006</option>
										<option value="2007" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2007') { echo "SELECTED"; } } else { if ($expires[2] == '2007') { echo "SELECTED"; } } ?>>2007</option>
										<option value="2008" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2008') { echo "SELECTED"; } } else { if ($expires[2] == '2008') { echo "SELECTED"; } } ?>>2008</option>
										<option value="2009" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2009') { echo "SELECTED"; } } else { if ($expires[2] == '2009') { echo "SELECTED"; } } ?>>2009</option>
										<option value="2010" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2010') { echo "SELECTED"; } } else { if ($expires[2] == '2010') { echo "SELECTED"; } } ?>>2010</option>
										<option value="2037" <?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2037') { echo "SELECTED"; } } else { if ($expires[2] == '2037') { echo "SELECTED"; } } ?>>2037</option>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>User Can Vote Every:</b></td>
								<td width="75%" colspan="3" align="center">
									Years: <select name="voteYears" class="text">
										<?php for ($i = 0;$i <= 10;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteYears'])) { if ($_REQUEST['voteYears'] == $i) { echo "SELECTED"; } } else { if ($years == $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Months: <select name="voteMonths" class="text">
										<?php for ($i = 0;$i <= 12;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteMonths'])) { if ($_REQUEST['voteMonths'] == $i) { echo "SELECTED"; } } else { if ($months== $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Days: <select name="voteDays" class="text">
										<?php for ($i = 0;$i <= 30;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteDays'])) { if ($_REQUEST['voteDays'] == $i) { echo "SELECTED"; } } else { if ($days == $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Hours: <select name="voteHours" class="text">
										<?php for ($i = 0;$i <= 23;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteHours'])) { if ($_REQUEST['voteHours'] == $i) { echo "SELECTED"; } } else { if ($hours == $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Minutes: <select name="voteMinutes" class="text">
										<?php for ($i = 0;$i <= 59;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteMinutes'])) { if ($_REQUEST['voteMinutes'] == $i) { echo "SELECTED"; } } else { if ($minutes == $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Seconds: <select name="voteSeconds" class="text">
										<?php for ($i = 0;$i <= 59;$i++) { ?>
										<option value="<?= $i; ?>" <?php if (isset ($_REQUEST['voteSeconds'])) { if ($_REQUEST['voteSeconds'] == $i) { echo "SELECTED"; } } else { if ($seconds == $i) { echo "SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td height="25" align="right"><b>Enable Voting:</b></td>
								<td colspan="3" align="center"><input name="voting" type="radio" value="yes" <?php if (isset ($_REQUEST['voting'])) { if ($_REQUEST['voting'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['voting'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="voting" type="radio" value="no"<?php if (isset ($_REQUEST['voting'])) { if ($_REQUEST['voting'] == 'no') {echo "CHECKED"; } } else { if ($myrow['voting'] == 'no') { echo "CHECKED"; } }  ?>> No</td>
							</tr>
							<tr class="text">
								<td height="25" align="right"><b>Enable Results:</b></td>
								<td colspan="3" align="center"><input name="graph" type="radio" value="yes" <?php if (isset ($_REQUEST['graph'])) { if ($_REQUEST['graph'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['graph'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="graph" type="radio" value="no"<?php if (isset ($_REQUEST['graph'])) { if ($_REQUEST['graph'] == 'no') {echo "CHECKED"; } } else { if ($myrow['graph'] == 'no') { echo "CHECKED"; } }  ?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>See Results Before Voting:</b></td>
								<td width="75%" colspan="3" align="center"><input name="results" type="radio" value="yes" <?php if (isset ($_REQUEST['results'])) { if ($_REQUEST['results'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['results'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="results" type="radio" value="no"<?php if (isset ($_REQUEST['results'])) { if ($_REQUEST['results'] == 'no') {echo "CHECKED"; } } else { if ($myrow['results'] == 'no') { echo "CHECKED"; } }  ?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>See Votes In Results:</b></td>
								<td align="center" width="75%" colspan="3"><input name="resultsvotes" type="radio" value="yes" <?php if (isset ($_REQUEST['resultsvotes'])) { if ($_REQUEST['resultsvotes'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['resultsvotes'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="resultsvotes" type="radio" value="no"<?php if (isset ($_REQUEST['resultsvotes'])) { if ($_REQUEST['resultsvotes'] == 'no') { echo "CHECKED"; } } else { if ($myrow['resultsvotes'] == 'no') { echo "CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text" bgcolor="#CCCCCC">
								<td width="25%" height="25" align="right"><b>Use IP Protection:</b></td>
								<td align="center" width="75%" colspan="3"><input name="ip" type="radio" value="yes" <?php if (isset ($_REQUEST['ip'])) { if ($_REQUEST['ip'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['ip'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="ip" type="radio" value="no"<?php if (isset ($_REQUEST['ip'])) { if ($_REQUEST['ip'] == 'no') { echo "CHECKED"; } } else { if ($myrow['ip'] == 'no') { echo "CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text" bgcolor="#CCCCCC">
								<td width="25%" height="25" align="right"><b>Use Cookie Protection:</b></td>
								<td align="center" width="75%" colspan="3"><input name="cookies" type="radio" value="yes" <?php if (isset ($_REQUEST['cookies'])) { if ($_REQUEST['cookies'] == 'yes') {echo "CHECKED"; } } else { if ($myrow['cookies'] == 'yes') { echo "CHECKED"; } } ?>> Yes <input name="cookies" type="radio" value="no"<?php if (isset ($_REQUEST['cookies'])) { if ($_REQUEST['cookies'] == 'no') {echo "CHECKED"; } } else { if ($myrow['cookies'] == 'no') { echo "CHECKED"; } }?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Status:</b></td>
								<td width="75%" colspan="3" align="center"><input name="status" type="radio" value="on" <?php if (isset ($_REQUEST['status'])) { if ($_REQUEST['status'] == 'on') {echo "CHECKED"; } } else { if ($myrow['status'] == 'on') { echo "CHECKED"; } } ?> > On (Visible) <input name="status" type="radio" value="off" <?php if (isset ($_REQUEST['status'])) { if ($_REQUEST['status'] == 'off') {echo "CHECKED"; } } else { if ($myrow['status'] == 'off') { echo "CHECKED"; } } ?>> Off (Invisible)</td>
							</tr>
							<tr align="center">
								<td height="25" colspan="4"><input name="poll" type="hidden" value="<?= $_REQUEST['poll']; ?>"><input name="stage" type="hidden" value="2"><input name="btnSubmit" type="submit" class="text" value="Finish &gt;&gt;"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<?php 
			
			} 
			
			if (isset ($_REQUEST['movedown'])) {
			
				@include ("../config.php");
			
				$numrows = mysql_num_rows (mysql_query ("SELECT optionid FROM options WHERE pollid='$_REQUEST[poll]'"));
			
				$myrow = mysql_fetch_array (mysql_query ("SELECT order_id FROM options WHERE pollid='$_REQUEST[poll]' AND optionid='$_REQUEST[movedown]'"));
				
				$order1 = ($myrow['order_id'] + 1);
				$order2 = '9999';
				$order3 = '1111';
				$order4 = $myrow['order_id'];
				
				if ($order1 <= $numrows) {
				
					mysql_query ("UPDATE options SET order_id='$order2' WHERE order_id='$order1' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order3' WHERE order_id='$order4' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order4' WHERE order_id='$order2' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order1' WHERE order_id='$order3' AND pollid='$_REQUEST[poll]'");
					
				}
				
			}
			
			if (isset ($_REQUEST['moveup'])) {
			
				@include ("../config.php");
			
				$numrows = mysql_num_rows (mysql_query ("SELECT optionid FROM options WHERE pollid='$_REQUEST[poll]'"));
			
				$myrow = mysql_fetch_array (mysql_query ("SELECT order_id FROM options WHERE pollid='$_REQUEST[poll]' AND optionid='$_REQUEST[moveup]'"));
				
				$order1 = ($myrow['order_id'] - 1);
				$order2 = '9999';
				$order3 = '1111';
				$order4 = $myrow['order_id'];
				
				if ($order1 >= '1') {
				
					mysql_query ("UPDATE options SET order_id='$order2' WHERE order_id='$order1' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order3' WHERE order_id='$order4' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order4' WHERE order_id='$order2' AND pollid='$_REQUEST[poll]'");
					mysql_query ("UPDATE options SET order_id='$order1' WHERE order_id='$order3' AND pollid='$_REQUEST[poll]'");
					
				}
				
			}
			
			if (!isset ($_REQUEST['stage'])) {
				
				poll ();
				
			} else {
			
				if ($_REQUEST['stage'] == 2) {
				
					include ("../config.php");
					
					$starts = $_REQUEST['startsDays']."/".$_REQUEST['startsMonths']."/".$_REQUEST['startsYears']; // Piece the start date together
					$expires = $_REQUEST['expiresDays']."/".$_REQUEST['expiresMonths']."/".$_REQUEST['expiresYears'];
					
					$vote = ($_REQUEST['voteYears'] * 31557600) + ($_REQUEST['voteMonths'] *  2629800) + ($_REQUEST['voteDays'] * 86400) + ($_REQUEST['voteHours'] * 3600) + ($_REQUEST['voteMinutes'] * 60) + $_REQUEST['voteSeconds'];
				
					for ($i = 1;$i <= count ($_REQUEST['images']);$i++) {
					
						$images[$i] = $_REQUEST['images'][$i];
						$order_id = $_REQUEST['order_id'][$i];
					
						mysql_query ("UPDATE options SET images='$images[$i]' WHERE pollid='$_REQUEST[poll]' AND order_id='$order_id'");
					
					}
				
					mysql_query ("UPDATE polls SET starts='$starts', expires='$expires', vote='$vote', voting='$_REQUEST[voting]', results='$_REQUEST[results]', graph='$_REQUEST[graph]', resultsvotes='$_REQUEST[resultsvotes]', ip='$_REQUEST[ip]', cookies='$_REQUEST[cookies]', status='$_REQUEST[status]' WHERE pollid='$_REQUEST[poll]'");
					
					complete ();
					
				}
				
			}
			
			?>
		</td>
	</tr>
</table>
</body>
</html>