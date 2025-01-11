<center>
<?php
$file = 'banchar';
if($is_gm != '0') {

	echo "<br>
		<b><u>Lock / unlock character menu</b></u><br>
		<br><a href='?function=banchar&sid=list&uc=".$uc."' target='_self'>Locked Character List</a> | <a href='?function=banchar&sid=ban&uc=".$uc."' target='_self'>Lock character</a> | <a href='?function=banchar&sid=unban&uc=".$uc."' target='_self'>Unlock Character</a><br><br><br>";

	if($_GET['sid'] == 'list') {
		$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
		$result = mysql_query("SELECT `charactername`,`reason` FROM `".$mysql['data']."`.`banned` WHERE `charactername` NOT LIKE '0'",$my_con);
		echo "<br><table class='innertab'>
			<tr>
				<td colspan='2' align='left'><b><u>Locked Character List</b></u></td>
			</tr>
			<tr>
				<td colspan='2' align='left'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'>Character Name</td>
				<td align='left'>Reason</td>
			</tr>";
			
		while($row = mysql_fetch_row($result)) {
			echo "<tr>
				<td align='left'>".$row[0]."</td>
				<td align='right'>".$row[1]."</td>
			</tr>";
		}
		echo "</table>";

	} elseif($_GET['sid'] == 'ban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banchar&sid=ban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>Lock character</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>Character Name</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='left'>Reason for banning</td>
							<td><input type='text' name='reason' maxlength='255'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Lock character'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
			$result = mssql_query("SELECT login_flag FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Back</a>";
			} elseif($count > '1') {
				echo "<br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Back</a>";
			} elseif($row[0] == 'N') {
				echo "<br>The character was already locked.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['reason'])) {
				echo "<br>Please give a reason for the blocking.<br><a href='javascript:history.back()'>Back</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'N' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mysql_query("INSERT INTO `".$mysql['data']."`.`banned` (`charactername`,`reason`) VALUES ('".$_POST['charname']."','".$_POST['reason']."')",$my_con);

				echo "<br>The character has been successfully blocked on the list.";
			}
		} else {
			echo "<br>".$language['s_error1'];
		}

	} elseif($_GET['sid'] == 'unban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banchar&sid=unban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>".$language['head4']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>".$language['split1']."</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='".$language['button2']."'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
			$result = mssql_query("SELECT login_flag FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>Back</a>";
			} elseif($count > '1') {
				echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>Back</a>";
			} elseif($row[0] == 'Y') {
				echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>Back</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'Y' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mysql_query("DELETE FROM `".$mysql['data']."`.`banned` WHERE `charactername` = '".$_POST['charname']."'",$my_con);

				echo "<br>".$language['ready2'];
			}
		} else {
			echo "<br>This function does not exist.";
		}		
	} else {
		echo "<br>".$language['s_error3'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>