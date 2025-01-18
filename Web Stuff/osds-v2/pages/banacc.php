<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
if($is_gm != '0') {
include "../config/mssql.conf.php";
	echo "<br>
		<img src='images/content/content_ban_acc.png' valign='left'><br>
		<br><a href='?do=banacc&sid=list&id=".$id."' target='_self'>Banned Account List</a> | <a href='?do=banacc&sid=ban&id=".$id."' target='_self'>Ban Account</a> | <a href='?do=banacc&sid=unban&id=".$id."' target='_self'>Unban Account</a><br><br><br>";

	if($_GET['sid'] == 'list') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result = mssql_query("SELECT accountname,reason FROM osds.dbo.banned WHERE accountname NOT LIKE '0'",$ms_con);
		echo "<br><table class='innertab'>
			<tr>
				<td colspan='2' align='center'><br></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'><b>Account Name</b></td>
				<td align='right'><b>Reason</b></td></tr>";
			
		while($row = mssql_fetch_row($result)) {
			echo "<tr>
				<td align='left'>".$row[0]."</td>
				<td align='right'>".$row[1]."</td>
			</tr>";
		}
		echo "</table>";

	} elseif($_GET['sid'] == 'ban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?do=banacc&sid=ban&id=".$id."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>Banned Account</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Account Name</td>
						<td><input type='text' name='accountname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'><b>Or</b></td>
					</tr>
					<tr>
						<td align='center'>Character Name</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Reason for banning</td>
							<td><input type='text' name='reason' maxlength='255'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Ban Account'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			if(empty($_POST['charname'])) {
				$result = mssql_query("SELECT login_tag FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accountname']."'",$ms_con);
				$count = mssql_num_rows($result);
				$row = mssql_fetch_row($result);
				$accountname = $_POST['accountname'];
			} else {
				$result1 = mssql_query("SELECT user_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
				$count1 = mssql_num_rows($result1);
				$row1 = mssql_fetch_row($result1);
				$result = mssql_query("SELECT login_tag,user_id FROM account.dbo.USER_PROFILE WHERE user_no = '".$row1[0]."'",$ms_con);
				$count = mssql_num_rows($result);
				$row = mssql_fetch_row($result);
				$accountname = $row[1];
			}

			if($count < '1') {
				echo "<br>Could not find the account name.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($count > '1') {
				echo "<br>There are multiple accounts with the same name found.<br>Please check this name in the database.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($row[0] == 'N') {
				echo "<br>The account has been banned.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif(empty($_POST['reason'])) {
				echo "<br>Please give a reason for the banning.<br><a href='javascript:history.back()'>Go Back</a>";
			} else {
				mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'N' WHERE user_id = '".$accountname."'",$ms_con);
				mssql_query("INSERT INTO osds.dbo.banned (accountname,reason) VALUES ('".$accountname."','".$_POST['reason']."')",$ms_con);

				echo "<br>The account has been successfully blocked on the list";
			}
		} else {
			echo "<br>This action does not exist.";
		}

	} elseif($_GET['sid'] == 'unban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?do=banacc&sid=unban&id=".$id."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>Unban Account</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Account Name</td>
						<td><input type='text' name='accountname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Unban Account'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$result = mssql_query("SELECT login_tag FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accountname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>Could not find the account name<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($count > '1') {
				echo "<br>There are multiple accounts with the same name found.<br>Please check this name in the database.<br><a href='javascript:history.back()'>Go Back</a>";
			} elseif($row[0] == 'Y') {
				echo "<br>The account is not banned.<br><a href='javascript:history.back()'>Go Back</a>";
			} else {
				mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'Y' WHERE user_id = '".$_POST['accountname']."'",$ms_con);
				mssql_query("DELETE FROM osds.dbo.banned WHERE accountname = '".$_POST['accountname']."'",$ms_con);

				echo "<br>The account was successful from the restricted list.";
			}
		} else {
			echo "<br><img src='images/error_action.png'>";
		}		
	} else {
		echo "<br>Select one of the Top Options please.";
	}
} else {
	echo "<br><img src='images/error_access.png'>";
}
?>
</center>