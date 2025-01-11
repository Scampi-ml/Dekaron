<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] != '2')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
if(empty($_POST['sendval'])) {
		echo "<table><form action=?do=sendmail method=POST>
				<tr><td class=header colspan=2 >Send mail</td></tr>
				<tr><td>To:<br><input type=text name=charname maxlength=20></td></tr>
				<tr><td>From:<br><input type=text name=from maxlength=50></td></tr>
				<tr><td>Subject:<br><input type=text name=subject maxlength=50 /></td></tr>
				<tr><td>Item ID:<br><input type=text name=itemid maxlength=10></td></tr>
				<tr><td>Dill:<br><input type=text name=dill maxlength=9></td></tr>
				<tr><td>Message:<br><textarea name=message cols=45 rows=5></textarea></td></tr>
				<tr><td colspan=2><input type=submit name=sendval value=Send></td></tr>
				</form></table>";
} elseif($_POST['sendval'] == 'Send') {
		
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".mssql_escape($_POST['charname'])."'");
		$rows = mssql_num_rows($result1);
		if(empty ($_POST['charname']) || $rows < '1') {
			echo "<br>Could not find the character name.<br><a href=javascript:history.back()>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['itemid'])) {
			echo "<br>The item ID does only consist numbers.<br><a href=javascript:history.back()>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['dill'])) {
			echo "<br>The dill does only consist numbers.<br><a href=javascript:history.back()>Back</a>";
		} else {
				$dill = $_POST['dill'];
				$itemid = $_POST['itemid'];
				$from = $_POST['from'];
				if (empty($dill)) {$dill = '0';}
				if (empty($itemid)) {$itemid = '0';}
				if (empty($from)) {$from = '[Anonymous]';}
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".mssql_escape($_POST['charname'])."'");
			$row2 = mssql_fetch_row($result2);
			mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".mssql_escape($row2[0])."','".mssql_escape($from)."',1,'".mssql_escape($_POST['subject'])."','".mssql_escape($_POST['message'])."','".mssql_escape($itemid)."','".mssql_escape($dill)."',0");
			echo "The item has been sent successfully.";
					}
		}

?>
