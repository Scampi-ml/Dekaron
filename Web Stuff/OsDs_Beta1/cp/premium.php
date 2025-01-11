<center>
<?php
$file = 'premium';
if($is_gm != '0') {
	if(empty($_POST['select'])) {
			echo "<center><br><form action='?function=premium&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>Coins</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>Character Name</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='Next'>
						</td>
					</tr>
				</table>
			</form></center>";
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($count > '1') {
			echo "<br>There were several characters with the same name found.<br>Please check that name in the database.<br><a href='javascript:history.back()'>Back</a>";
		} else {
			$result2 = mssql_query("SELECT user_no,character_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);

			$result3 = mssql_query("SELECT amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".$row2[0]."'",$ms_con);
			$row3 = mssql_fetch_row($result3);

			$result4 = mssql_query("SELECT user_id FROM account.dbo.Tbl_user WHERE user_no = '".$row2[0]."'",$ms_con);
			$row4 = mssql_fetch_row($result4);

			$result5 = mssql_query("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".$row2[0]."'",$ms_con);
			$count5 = mssql_num_rows($result5);

			if($count5 == '0') {
				$coins = '0';
			} else {
				$coins = $row3[0] + $row3[1];
			}
	
			echo "<center><br><form action='?function=premium&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>Coins</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>Selected Account:</td>
						<td align='left'><input type='text' name='accname' maxlength='20' value='".$row4[0]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='left'>Selected Character:</td>
						<td align='left'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>Current Coins</td>
						<td align='left'><input type='text' name='coins' maxlength='20' value='".$coins."' readonly='readonly' size='20'>
						</td>
					</tr>
					<tr>
						<td align='left'>Enter X Coins (+)</td>
						<td align='left'><input type='text' name='coins_p' maxlength='20' value='0' size='20'></td>
					</tr>
					<tr>
						<td align='left'>Suppose X Coins (-)</td>
						<td align='left'><input type='text' name='coins_m' maxlength='20' value='0' size='20'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left' colspan='2'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[1]."'>
							<input type='hidden' name='user_no' value='".$row2[0]."'>
							<input type='hidden' name='is_insert' value='".$count5."'>
							<input type='submit' value='Apply'>
						</td>
					</tr>
				</table>
			</form></center>";
		}
	} elseif($_POST['select'] == '2') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT login_flag,user_id FROM account.dbo.USER_PROFILE WHERE user_no = '".$_POST['user_no']."'",$ms_con);
		$row1 = mssql_fetch_row($result1);

		if($row1[0] == '1100') {
			echo "<br>This account can not currently modify coins since it is online.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['coins_p'])) {
			echo "<br>Enter X coins consists not only of pay.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['coins_m'])) {
			echo "<br>Suppose X coins consists not only of pay.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['is_insert'] == '0') {
			echo "<br>The account has the D-Store is not yet visited, and therefore can not be credited coins.<br><a href='javascript:history.back()'>Back</a>";
		} else {

			$new_coins = $_POST['coins'] + $_POST['coins_p'];
			$new_coins = $new_coins - $_POST['coins_m'];

			$coins = $new_coins / 2;
			$coins = round($coins,0);

			mssql_query("UPDATE
						cash.dbo.user_cash
					SET
						amount = '".$coins."',
						free_amount = '".$coins."'
					WHERE
						user_no = '".$_POST['user_no']."'
					",$ms_con);

			$ready_msg = preg_replace("{ACCOUNTNAME}",$row1[1],"The Account ACCOUNTNAME were successfully COINSGIVE added and COINSTAKE deducted.<br>This is the new stand Coins COINSTOTAL.</center>");
			$ready_msg = preg_replace("{COINSGIVE}",$_POST['coins_p'],$ready_msg);
			$ready_msg = preg_replace("{COINSTAKE}",$_POST['coins_m'],$ready_msg);
			$ready_msg = preg_replace("{COINSTOTAL}",$new_coins,$ready_msg);

			echo "<br>".$ready_msg;

		}
	} else {
		echo "<br>This function does not exist.";
	}
} else {
	echo "<br>You are not a GM , you have no access to this function.";
}

?>
</center>