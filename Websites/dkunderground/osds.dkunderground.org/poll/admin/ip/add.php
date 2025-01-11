<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | IP Blocker > Create A Block</title>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'ipblocker'; @include ("../template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">IP Blocker</a> > <b>Create A Block</b></td>
				</tr>
			</table>
			<br>
			<?php function complete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=index.php"><b>Success:</b> Your block has been added to the database</td>
				</tr>
			</table>
			<br>
			<?php } function error_incomplete () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=javascript: history.go(-1)"><b>Error:</b> Please fill in the IP field</td>
				</tr>
			</table>
			<br>
			<?php } function error_ip () { ?>
			<table width="100%"  border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><meta http-equiv="refresh" content="2;URL=javascript: history.go(-1)"><b>Error:</b> The IP address already exists</td>
				</tr>
			</table>
			<br>
			<?php } function add () { ?>
			<form name="frmAdd" method="post" action="add.php">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td width="25%" height="25" align="right"><b>IP Address:</b></td>
					<td width="75%" align="center"><input name="txtIP" type="text" class="text" size="60" <?php if (isset ($_REQUEST['txtIP'])) { echo "value=\"".$_REQUEST['txtIP']."\""; } ?> maxlength="15"></td>
				</tr>
				<tr class="text">
					<td width="25%" height="25" align="right" valign="top"><b>Poll(s) To Block From IP:</b><br>(CTRL Click to select multiple)</td>
					<td width="75%" align="center">
						<select name="lstPolls[]" size="8" class="text" multiple>
							<option value="all" SELECTED>All Polls</option>
						<?php
						
						include ("../../config.php");
						
						$result = mysql_query ("SELECT title, pollid FROM polls ORDER BY pollid DESC");
						
						while ($myrow = mysql_fetch_array ($result)) {
						
						?>
							<option value="<?= $myrow['title']; ?>"><?= substr ($myrow['title'], 0, 67); ?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr class="text">
					<td width="25%" height="25" align="center" colspan="2"><input name="stage" type="hidden" value="2"><input name="btnSubmit" type="submit" class="text" value="Finish &gt;&gt;"></td>
				</tr>
			</table>
			</form>
			<?php } ?>
		</td>
	</tr>
</table>
<?php 

if (!isset ($_REQUEST['stage'])) {

	add ();
	
} 

if (isset ($_REQUEST['stage'])) {

	include ("../../config.php");
	
	$ipquery = mysql_num_rows (mysql_query ("SELECT ip FROM blocked WHERE ip='$_REQUEST[txtIP]'"));
	
}

if (isset ($_REQUEST['stage']) && $_REQUEST['txtIP'] != '' && $ipquery == 0) {

	$myrow = mysql_fetch_array (mysql_query ("SELECT blockedid FROM blocked ORDER BY blockedid DESC"));
	
	$id = $myrow['blockedid'] + 1;
	
	mysql_query ("INSERT INTO blocked (blockedid, ip, polls) VALUES ('$id', '$_REQUEST[txtIP]', '')");
	
	foreach ($_REQUEST['lstPolls'] as $poll) {
	
		$myrow2 = mysql_fetch_array (mysql_query ("SELECT polls FROM blocked WHERE blockedid='$id'"));
		
		$polls = $myrow2['polls'].$poll.";";
		
		mysql_query ("UPDATE blocked SET polls='$polls' WHERE blockedid='$id'");
	
	}
	
	complete ();

}

if (isset ($_REQUEST['stage']) && $_REQUEST['txtIP'] == '') {

	error_incomplete ();
	
}

if (isset ($_REQUEST['stage']) && $ipquery > 0) {

	error_ip ();
	
}

?>
</body>
</html>