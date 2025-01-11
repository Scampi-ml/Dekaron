<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Poll | Admin | IP Blocker > View A Block</title>
<link href="../../css/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $page = 'ipblocker'; @include ("../template.php"); ?>
	<tr>
		<td colspan="4">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td align="center" height="25"><a href="index.php" class="text">IP Blocker</a> > <b>View A Block</b></td>
				</tr>
			</table>
			<br>
			<?php 
			
			function view () {
			
				include ("../../config.php");
				
				$myrow = mysql_fetch_array (mysql_query ("SELECT * FROM blocked"));			
			
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="border">
				<tr class="text">
					<td width="25%" align="right" height="25"><b>Blockedid:</b></td>
					<td width="75%" align="center"><?= $myrow['blockedid']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25"><b>IP Address:</b></td>
					<td width="75%" align="center"><?= $myrow['ip']; ?></td>
				</tr>
				<tr class="text">
					<td width="25%" align="right" height="25" valign="top"><b>Blocked Polls:</b></td>
					<td width="75%" align="center">
						<?php
						
						 $polls = explode (";", $myrow['polls']); 
						 
						 for ($i = 0; $i < count ($polls);$i++) {
						 
						 	if ($polls[$i] == 'all') {
							
								echo "All Polls<br>";
								
							} else {
						 
						 		echo $polls[$i]."<br>";
							
							}
							
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
			<?php } ?>
		</td>
	</tr>
</table>
<?php 

view ();

?>
</body>
</html>