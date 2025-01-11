<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | Polls > Create A Poll</title>
<link href="../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'polls'; @include ("template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">Polls</a> > <b>Create A Poll</b></td>
				</tr>
			</table>
			<br>
			<?php function complete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=index.php"><b>Success:</b> Your poll has been added to the database</td>
				</tr>
			</table>
			<br>
			<?php } function error_incomplete () { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=javascript: history.go(-1)"><b>Error:</b> You have not filled in all the fields!</td>
				</tr>
			</table>
			<br>
			<?php } function error_options () { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=javascript: history.go(-1)"><b>Error:</b> You have to choose more than 1 option!</td>
				</tr>
			</table>
			<br>
			<?php } function error_title () { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=javascript: history.go(-1)"><b>Error:</b> A Poll with that title already exists!</td>
				</tr>
			</table>
			<br>
			<?php } function options () { ?>
			<form name="frmOptions" method="get" action="add.php">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td width="25%" height="25" align="right"><b>Number Of Options:</b></td>
					<td align="center" width="75%"><input name="txtOptions" type="text" class="text" size="60"></td>
				</tr>
				<tr align="center">
					<td height="25" colspan="2"><input name="stage" type="hidden" value="2"><input name="btnOptions" type="submit" value="Step 2 &gt;&gt;" class="text"></td>
				</tr>
			</table>
			</form>
			<?php } function poll () { ?>
			<form name="frmPoll" method="post" action="add.php">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Title:</b></td>
								<td align="center" width="75%"><input name="txtTitle" type="text" class="text" size="60" <?php if (isset ($_REQUEST['txtTitle'])) { echo "value=\"".$_REQUEST['txtTitle']."\""; } ?>></td>
							</tr>
							<?php for ($i = 1; $i <= $_REQUEST['txtOptions'];$i++ ) { ?>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Option <?= $i; ?>:</b></td>
								<td align="center" width="75%">
									<input name="txtOption[<?= $i; ?>]" type="text" class="text" size="44" <?php if (isset ($_REQUEST['txtOption'][$i])) { echo "value=\"".$_REQUEST['txtOption'][$i]."\""; } ?>>
									<select name="images[<?= $i; ?>]" class="text">
										<option value="random"<?php if (isset ($_REQUEST['images'])) { if ($_REQUEST['images'] == 'random') { echo " SELECTED"; } } else { echo " SELECTED"; } ?>>Random</option>
									<?php include ("../config.php"); if ($handle = opendir ($dir)) { while (false !== ($file = readdir($handle))) {if ($file != '.' && $file != '..') { ?>
										<option value="<?= $file; ?>"<?php if (isset ($_REQUEST['images'])) { if ($_REQUEST['images'] == $files) { echo " SELECTED"; } }?>><?= $file; ?></option>
									<?php } } closedir ($handle);  } ?>
									</select>
								</td>
							</tr>
							<?php } ?>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Starts:</b></td>
								<td align="center" width="75%">
									<select name="startsDays" class="text">
										<?php for ($i = 1;$i <= 31;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>"<?php if (isset ($_REQUEST['startsDays'])) { if ($_REQUEST['startsDays'] == $i) { echo " SELECTED"; } } else { if (date ("d") == $i) { echo " SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="startsMonths" class="text">
										<?php for ($i = 1;$i <= 12;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>"<?php if (isset ($_REQUEST['startsMonths'])) { if ($_REQUEST['startsMonths'] == $i) { echo " SELECTED"; } } else { if (date ("m") == $i) { echo " SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="startsYears" class="text">
										<option value="2005"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2005') { echo " SELECTED"; } } else { if (date ("Y") == '2005') { echo " SELECTED"; } } ?>>2005</option>
										<option value="2006"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2006') { echo " SELECTED"; } } else { if (date ("Y") == '2006') { echo " SELECTED"; } } ?>>2006</option>
										<option value="2007"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2007') { echo " SELECTED"; } } else { if (date ("Y") == '2007') { echo " SELECTED"; } } ?>>2007</option>
										<option value="2008"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2008') { echo " SELECTED"; } } else { if (date ("Y") == '2008') { echo " SELECTED"; } } ?>>2008</option>
										<option value="2009"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2009') { echo " SELECTED"; } } else { if (date ("Y") == '2009') { echo " SELECTED"; } } ?>>2009</option>
										<option value="2010"<?php if (isset ($_REQUEST['startsYears'])) { if ($_REQUEST['startsYears'] == '2010') { echo " SELECTED"; } } else { if (date ("Y") == '2010') { echo " SELECTED"; } } ?>>2010</option>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Poll Expires:</b></td>
								<td align="center" width="75%">
									<select name="expiresDays" class="text">
										<?php for ($i = 1;$i <= 31;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>"<?php if (isset ($_REQUEST['expiresDays'])) { if ($_REQUEST['expiresDays'] == $i) { echo " SELECTED"; } } else { if (date ("d") == $i) { echo " SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="expiresMonths" class="text">
										<?php for ($i = 1;$i <= 12;$i++) { ?>
										<option value="<?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?>"<?php if (isset ($_REQUEST['expiresMonths'])) { if ($_REQUEST['expiresMonths'] == $i) { echo " SELECTED"; } } else { if (date ("m") == $i) { echo " SELECTED"; } } ?>><?php if (strlen ($i) == 1) { echo "0".$i; } else { echo $i; } ?></option>
										<?php } ?>
									</select>
									&nbsp;
									<select name="expiresYears" class="text">
										<option value="2005"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2005') { echo " SELECTED"; } } ?>>2005</option>
										<option value="2006"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2006') { echo " SELECTED"; } } ?>>2006</option>
										<option value="2007"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2007') { echo " SELECTED"; } } ?>>2007</option>
										<option value="2008"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2008') { echo " SELECTED"; } } ?>>2008</option>
										<option value="2009"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2009') { echo " SELECTED"; } } ?>>2009</option>
										<option value="2010"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2010') { echo " SELECTED"; } } ?>>2010</option>
										<option value="2037"<?php if (isset ($_REQUEST['expiresYears'])) { if ($_REQUEST['expiresYears'] == '2037') { echo " SELECTED"; } } else { echo " SELECTED"; } ?>>2037</option>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>User Can Vote Every:</b></td>
								<td align="center" width="75%">
									Years: <select name="voteYears" class="text">
										<?php for ($i = 0;$i <= 10;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteYears'])) { if ($_REQUEST['voteYears'] == $i) { echo " SELECTED"; } } else { if ($i == 0) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Months: <select name="voteMonths" class="text">
										<?php for ($i = 0;$i <= 12;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteMonths'])) { if ($_REQUEST['voteMonths'] == $i) { echo " SELECTED"; } } else { if ($i == 0) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Days: <select name="voteDays" class="text">
										<?php for ($i = 0;$i <= 30;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteDays'])) { if ($_REQUEST['voteDays'] == $i) { echo " SELECTED"; } } else { if ($i == 1) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Hours: <select name="voteHours" class="text">
										<?php for ($i = 0;$i <= 23;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteHours'])) { if ($_REQUEST['voteHours'] == $i) { echo " SELECTED"; } } else { if ($i == 0) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Minutes: <select name="voteMinutes" class="text">
										<?php for ($i = 0;$i <= 59;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteMinutes'])) { if ($_REQUEST['voteMinutes'] == $i) { echo " SELECTED"; } } else { if ($i == 0) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
									&nbsp;
									Seconds: <select name="voteSeconds" class="text">
										<?php for ($i = 0;$i <= 59;$i++) { ?>
										<option value="<?= $i; ?>"<?php if (isset ($_REQUEST['voteSeconds'])) { if ($_REQUEST['voteSeconds'] == $i) { echo " SELECTED"; } } else { if ($i == 0) { echo " SELECTED"; } } ?>><?= $i; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr class="text">
								<td height="25" align="right"><b>Enable Voting:</b></td>
								<td align="center"><input name="voting" type="radio" value="yes"<?php if (isset ($_REQUEST['voting'])) { if ($_REQUEST['voting'] == 'yes') {echo " CHECKED"; } } else { echo " CHECKED"; } ?>> Yes <input name="voting" type="radio" value="no"<?php if (isset ($_REQUEST['voting'])) { if ($_REQUEST['voting'] == 'no') {echo " CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text">
								<td height="25" align="right"><b>Enable Results:</b></td>
								<td align="center"><input name="graph" type="radio" value="yes"<?php if (isset ($_REQUEST['graph'])) { if ($_REQUEST['graph'] == 'yes') {echo " CHECKED"; } } else { echo " CHECKED"; } ?>> Yes <input name="graph" type="radio" value="no"<?php if (isset ($_REQUEST['graph'])) { if ($_REQUEST['graph'] == 'no') {echo " CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>See Results Before Voting:</b></td>
								<td align="center" width="75%"><input name="results" type="radio" value="yes"<?php if (isset ($_REQUEST['results'])) { if ($_REQUEST['results'] == 'yes') {echo " CHECKED"; } } else { echo " CHECKED"; } ?>> Yes <input name="results" type="radio" value="no"<?php if (isset ($_REQUEST['results'])) { if ($_REQUEST['results'] == 'no') {echo " CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>See Votes In Results:</b></td>
								<td align="center" width="75%"><input name="resultsvotes" type="radio" value="yes"<?php if (isset ($_REQUEST['resultsvotes'])) { if ($_REQUEST['resultsvotes'] == 'yes') {echo  " CHECKED"; } } else { echo " CHECKED"; } ?>> Yes <input name="resultsvotes" type="radio" value="no"<?php if (isset ($_REQUEST['resultsvotes'])) { if ($_REQUEST['resultsvotes'] == 'no') {echo " CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text" bgcolor="#CCCCCC">
								<td width="25%" height="25" align="right"><b>Use IP Protection:</b></td>
								<td align="center" width="75%"><input name="ip" type="radio" value="yes"<?php if (isset ($_REQUEST['ip'])) { if ($_REQUEST['ip'] == 'yes') {echo " CHECKED"; } } else { echo " CHECKED"; } ?>> Yes <input name="ip" type="radio" value="no"<?php if (isset ($_REQUEST['ip'])) { if ($_REQUEST['ip'] == 'no') {echo " CHECKED"; } } ?>> No</td>
							</tr>
							<tr class="text" bgcolor="#CCCCCC">
								<td width="25%" height="25" align="right"><b>Use Cookie Protection:</b></td>
								<td align="center" width="75%"><input name="cookies" type="radio" value="yes"<?php if (isset ($_REQUEST['cookies'])) { if ($_REQUEST['cookies'] == 'yes') {echo " CHECKED"; } } ?>> Yes <input name="cookies" type="radio" value="no"<?php if (isset ($_REQUEST['cookies'])) { if ($_REQUEST['cookies'] == 'no') {echo " CHECKED"; } } else { echo " CHECKED"; } ?>> No</td>
							</tr>
							<tr class="text">
								<td width="25%" height="25" align="right"><b>Status:</b></td>
								<td align="center" width="75%"><input name="status" type="radio" value="on"<?php if (isset ($_REQUEST['status'])) { if ($_REQUEST['status'] == 'on') {echo " CHECKED"; } } else { echo " CHECKED"; } ?> > On (Visible) <input name="status" type="radio" value="off"<?php if (isset ($_REQUEST['status'])) { if ($_REQUEST['status'] == 'off') {echo " CHECKED"; } } ?>> Off (Invisible)</td>
							</tr>
							<tr align="center">
								<td height="25" colspan="2"><input name="stage" type="hidden" value="3"><input name="btnSubmit" type="submit" class="text" value="Finish &gt;&gt;"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<?php 
			
			} 
			
			if (!isset ($_REQUEST['stage'])) {
			
				options ();
				
			}
			
			if (isset ($_REQUEST['stage'])) {
			
				if ($_REQUEST['stage'] == 2 && floor ($_REQUEST['txtOptions']) > 1) {
				
					poll ();
					
				}
				
				if ($_REQUEST['stage'] == 2 && floor ($_REQUEST['txtOptions']) <= 1) {
			
					error_options ();
					
				}
				
				if ($_REQUEST['stage'] == 3) {
				
					include ("../config.php");
					
					$titlerows = mysql_num_rows (mysql_query ("SELECT title FROM polls WHERE title='$_REQUEST[txtTitle]'"));
					
					if ($titlerows == 1) { // Check to see if title already exists
					
						error_title ();
						
					}
				
				}
				
				if ($_REQUEST['stage'] == 3 && ($_REQUEST['txtTitle'] == '' | count ($_REQUEST['txtOption']) <= 1)) {
				
					error_incomplete ();
					
				}
				
				if ($_REQUEST['stage'] == 3 && $_REQUEST['txtTitle'] != '' && $titlerows == 0) {
					
					$date = date ("d/m/Y");
					
					$starts = $_REQUEST['startsDays']."/".$_REQUEST['startsMonths']."/".$_REQUEST['startsYears']; // Piece the start date together
					$expires = $_REQUEST['expiresDays']."/".$_REQUEST['expiresMonths']."/".$_REQUEST['expiresYears'];
					
					// Use time () to provide a suitable time for the voting lifespan of the poll
					$vote = ($_REQUEST['voteYears'] * 31557600) + ($_REQUEST['voteMonths'] *  2629800) + ($_REQUEST['voteDays'] * 86400) + ($_REQUEST['voteHours'] * 3600) + ($_REQUEST['voteMinutes'] * 60) + $_REQUEST['voteSeconds'];
					
					$options = count ($_REQUEST['txtOption']);
					
					$optionrows = mysql_fetch_array (mysql_query ("SELECT optionid FROM options ORDER BY optionid DESC"));
					$pollrows = mysql_fetch_array (mysql_query ("SELECT pollid FROM polls ORDER BY pollid DESC"));
					
					$pollid = $pollrows['pollid'] + 1;
					
					for ($i = 1;$i <= $options;$i++) {
					
						$optionid = $optionrows['optionid'] + $i;
						$option[$i] = $_REQUEST['txtOption'][$i];
						$images[$i] = $_REQUEST['images'][$i];
						
						mysql_query ("INSERT INTO options (optionid, pollid, options, images, votes, order_id) VALUES ('$optionid', '$pollid', '$option[$i]', '$images[$i]', '0', '$i')");
					
					}
					
					mysql_query ("INSERT INTO polls (pollid, title, starts, expires, vote, voting, results, graph, resultsvotes, ip, cookies, subdate, status) VALUES ('$pollid', '$_REQUEST[txtTitle]', '$starts', '$expires', '$vote', '$_REQUEST[voting]', '$_REQUEST[results]', '$_REQUEST[graph]', '$_REQUEST[resultsvotes]', '$_REQUEST[ip]', '$_REQUEST[cookies]', '$date', '$_REQUEST[status]')");
					
					complete ();
				
				}
				
			}
			
			?>
		</td>
	</tr>
</table>
</body>
</html>