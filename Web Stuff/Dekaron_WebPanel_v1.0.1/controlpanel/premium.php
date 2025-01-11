<center>
<?php
$file = 'premium';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
			echo "<center><br><form action='?function=premium&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head1']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split1']."</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='".$language['button1']."'>
						</td>
					</tr>
				</table>
			</form></center>";
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($count > '1') {
			echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
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
						<td colspan='2' align='center'><b><u>".$language['head1']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split2']."</td>
						<td align='center'><input type='text' name='accname' maxlength='20' value='".$row4[0]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split3']."</td>
						<td align='center'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split4']."</td>
						<td align='center'><input type='text' name='coins' maxlength='20' value='".$coins."' readonly='readonly' size='20'>
						</td>
					</tr>
					<tr>
						<td align='center'>".$language['split5']."</td>
						<td align='center'><input type='text' name='coins_p' maxlength='20' value='0' size='20'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split6']."</td>
						<td align='center'><input type='text' name='coins_m' maxlength='20' value='0' size='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[1]."'>
							<input type='hidden' name='user_no' value='".$row2[0]."'>
							<input type='hidden' name='is_insert' value='".$count5."'>
							<input type='submit' value='".$language['button2']."'>
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
			echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['coins_p'])) {
			echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['coins_m'])) {
			echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['is_insert'] == '0') {
			echo "<br>".$language['error6']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
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

			$ready_msg = preg_replace("{ACCOUNTNAME}",$row1[1],$language['ready1']);
			$ready_msg = preg_replace("{COINSGIVE}",$_POST['coins_p'],$ready_msg);
			$ready_msg = preg_replace("{COINSTAKE}",$_POST['coins_m'],$ready_msg);
			$ready_msg = preg_replace("{COINSTOTAL}",$new_coins,$ready_msg);

			echo "<br>".$ready_msg;

		}
	} else {
		echo "<br>".$language['s_error1'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>