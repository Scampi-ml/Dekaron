<center>
<?php
$file = 'account';
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=account&uc=".$uc."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='left'><b><u>Modify Account</b></u></td>
				</tr>
				<tr>
					<td colspan='2' align='left'>&nbsp;</td>
				</tr>
				<tr>
					<td align='left'>Character Name</td>
					<td><input type='text' name='charname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='left' colspan='2'><b>or</b></td>
				</tr>
				<tr>
					<td align='left'>Account Name</td>
					<td><input type='text' name='accname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='left' colspan='2'>
						<input type='hidden' name='select' value='1'>
						<input type='submit' value='View Account Information'>
					</td>
				</tr>
			</table>
		</form></center>";
	} elseif($_POST['select'] == '1') {

		if(empty($_POST['charname']) && empty($_POST['accname'])) {
			echo "<br>You must input at least a character name or account name below.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!empty($_POST['charname']) && !empty($_POST['accname'])) {
			echo "<br>You may only character name or account name below.<br><a href='javascript:history.back()'>Back</a>";
		} else {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

			if(empty($_POST['charname'])) {
				$result1 = mssql_query("SELECT user_no FROM account.dbo.Tbl_user WHERE user_id = '".$_POST['accname']."'",$ms_con);
				$count1 = mssql_num_rows($result1);
				$row1 = mssql_fetch_row($result1);
			} else {
				$result1 = mssql_query("SELECT user_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
				$count1 = mssql_num_rows($result1);
				$row1 = mssql_fetch_row($result1);
				$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_no = '".$row1[0]."'",$ms_con);
				$count2 = mssql_num_rows($result2);
			}


			if(empty($_POST['charname']) && $count1 < '1') {
				echo "<br>Could not account with the names.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['charname']) && $count1 > '1') {
				echo "<br>The specified account name exists in the database several times.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['accname']) && $count1 < '1') {
				echo "<br>Could not update the character name.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['accname']) && $count1 > '1') {
				echo "<br>The specified character name exists several times in the database.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['accname']) && $count2 < '1') {
				echo "<br>The account on the specified character is not found.<br><a href='javascript:history.back()'>Back</a>";
			} elseif(empty($_POST['accname']) && $count2 > '1') {
				echo "<br>The account on which this character is running there several times.<br><a href='javascript:history.back()'>Back</a>";
			} else {

				$result3 = mssql_query("SELECT user_id,user_pwd,user_mail,referred FROM account.dbo.Tbl_user WHERE user_no = '".$row1[0]."'",$ms_con);
				$row3 = mssql_fetch_row($result3);

				echo "<center><form action='?function=account&uc=".$uc."' method='POST'>
					<table class='innertab'>
						<tr>
							<td colspan='3' align='left'><b><u>Modify Account</b></u></td>
						</tr>
						<tr>
							<td colspan='3' align='left'>&nbsp;</td>
						</tr>
						<tr>
							<td align='left'>Type</td>
							<td align='left'>Current Stats</td>
							<td align='left'>New Stats</td>
						</tr>
						<tr>
							<td align='left'>Account Name</td>
							<td align='left'>".$row3[0]."</td>
							<td align='left'><input type='text' name='user_acc' maxlength='20' value='".$row3[0]."'></td>
						</tr>
						<tr>
							<td align='left'>Acc. Password</td>
							<td align='left'>".$row3[1]."</td>
							<td align='left'><input type='text' name='user_pwd' maxlength='20' value='".$row3[1]."'></td>
						</tr>
						<tr>
							<td align='left'>Acc. E-Mail</td>
							<td align='left'>".$row3[2]."</td>
							<td align='left'><input type='text' name='user_mail' maxlength='100' value='".$row3[2]."'></td>
						</tr>
							<tr>
							<td align='left'>Referred by</td>
							<td align='left'>".$row3[4]."</td>
							<td align='left'><input type='text' name='referred' maxlength='20' value='".$row3[4]."'></td>
						</tr>

						<tr>
							<td align='left' colspan='3'>
								<input type='hidden' name='select' value='2'>
								<input type='hidden' name='user_no' value='".$row1[0]."'>
								<input type='submit' value='Account Update'>
							</td>
						</tr>
					</table>
				</form></center>";

			}
		}
	} elseif($_POST['select'] == '2') {

		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

		$result1 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['user_mail']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if(empty($_POST['user_pwd']) || empty($_POST['user_mail'])) {
			echo "<br>You have not filled in all fields.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['user_pwd'])) {
			echo "<br>The password contains characters which are not allowed in the password.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(strlen($_POST['user_pwd']) < 6 || strlen($_POST['user_pwd']) > 12) {
			echo "<br>The password must be at least 6 and not more than 20 characters long.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['user_mail'])) {
			echo "<br>This is not a valid email address.<br><a href='javascript:history.back()'>Back</a>";
		} else {

			$crypt_user_pwd = md5($_POST['user_pwd']);

			mssql_query("UPDATE 
					account.dbo.Tbl_user 
				SET 
					user_pwd = '".$_POST['user_pwd']."',
					user_mail = '".$_POST['user_mail']."',
					referred = '".$_POST['referred']."'
				WHERE
					user_no = '".$_POST['user_no']."'",$ms_con);

			mssql_query("UPDATE 
					account.dbo.USER_PROFILE 
				SET 
					user_pwd = '".$crypt_user_pwd."'
				WHERE
					user_no = '".$_POST['user_no']."'",$ms_con);

			echo "<br>The account update was successful";

		}
	} else {
		echo "<br>This function does not exist";
	}
} 
?>
</center>