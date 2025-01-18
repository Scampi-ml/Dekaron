
<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
if($is_gm != '0') {

	echo "<br>
		<img src='images/content/content_ban_char.png' valign='left'><br>
		<br><a href='?do=banchar&sid=list&id=".$id."' target='_self'>Banned Character List</a> | <a href='?do=banchar&sid=ban&id=".$id."' target='_self'>Ban character</a> | <a href='?do=banchar&sid=unban&id=".$id."' target='_self'>Unban Character</a><br><br><br>";

	if($_GET['sid'] == 'list') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result = mssql_query("SELECT charactername,reason FROM osds.dbo.banned WHERE charactername NOT LIKE '0'",$ms_con);
		echo "<br><table class='innertab'>
			<tr>
				<td colspan='2' align='center'><br></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'><b>---- Character ----</b></td>
				<td align='left'><b>---- Reason ----</b></td>
			</tr>";
			
		while($row = mssql_fetch_row($result)) {
			echo "<tr>
				<td align='left'>".$row[0]."</td>
				<td align='left'>".$row[1]."</td>
			</tr>";
		}
		echo "</table>";

	} elseif($_GET['sid'] == 'ban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?do=banchar&sid=ban&id=".$id."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>Ban character</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Character Name</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center'>Reason for banning</td>
							<td><input type='text' name='reason' maxlength='255'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Ban character'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$result = mssql_query("SELECT login_flag FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($count > '1') {
				echo "<br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($row[0] == 'N') {
				echo "<br>The character was already banned.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif(empty($_POST['reason'])) {
				echo "<br>Please give a reason for the banning.<br><a href='javascript:history.back()'>Go Back</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'N' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mssql_query("INSERT INTO osds.dbo.banned (charactername,reason) VALUES ('".$_POST['charname']."','".$_POST['reason']."')",$ms_con);

				echo "<br>The character has been successfully banned on the list.";
			}
		} else {
			echo "<br>This action does not exist.";
		}

	} elseif($_GET['sid'] == 'unban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?do=banchar&sid=unban&id=".$id."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>Unban Character</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Character Name</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Unban Character'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$result = mssql_query("SELECT login_flag FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($count > '1') {
				echo "<br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($row[0] == 'Y') {
				echo "<br>The character is not banned.<br><a href='javascript:history.back()'>Go Back</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'Y' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mssql_query("DELETE FROM osds.dbo.banned WHERE charactername = '".$_POST['charname']."'",$ms_con);

				echo "<br>The character was added successful to the restricted list.";
			}
		} else {
			echo "<br><img src='images/error_action.png'>";
		}		
	} else {
		echo "<br>Select one of the top options.";
	}
} else {
	echo "<br><img src='images/error_access.png'>";
}

?>
</center>