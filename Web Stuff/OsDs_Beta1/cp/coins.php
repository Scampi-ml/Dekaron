<center>
<?php
$dil_coins = '10000'; //xxxxx DIL = 1 Coin
$file = 'coins';
if(empty($_POST['select'])) {
	echo "<center><form action='?function=coins&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='2' align='left'><b><u>Coins Exchange</u></b></td>
			</tr>
			<tr>
				<td colspan='2' align='left'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'>Character Name</td>
				<td><select name='charname_maxcoins'>";
					$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
					$result = mssql_query("SELECT character_no,character_name,dwMoney FROM character.dbo.user_character WHERE user_no = '".$user_no."'",$ms_con);

					while($row = mssql_fetch_row($result)) {
						$coins = $row[2]/$dil_coins;
						$coins = explode(".",$coins);
						$names_coins = preg_replace("{NAME}",$row[1],"Name can have a maximum COINS coins swap.");
						$names_coins = preg_replace("{COINS}",$coins[0],$names_coins);
						echo "<option value='".$row[0]."_".$coins[0]."'>".$names_coins."</option>";
					}
				echo "</select></td>
			</tr>
			<tr>
				<td align='left'>How many coins should it be?</td>
				<td align='left'><input type='text' name='curcoins' maxlength='6'></td>
			</tr>
			<tr>
				<td align='left' colspan='2'>
					<input type='hidden' name='select' value='1'>
					<input type='submit' value='Exchange Coins'>
				</td>
			</tr>
		</table>
	</form></center>";
} elseif($_POST['select'] == '1') {
	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$user_no."'",$ms_con);
	$row1 = mssql_fetch_row($result1);

	list($char_no,$coins_max) = explode("_",$_POST['charname_maxcoins']);

	if($row1[0] == '1100') {
		echo "<br>You are currently online, so unfortunately you can not exchange coins.<br><a href='javascript:history.back()'>Back</a>";
	} elseif(!preg_match("/[0-9]?/",$_POST['curcoins'])) {
		echo "<br>Please enter only numbers in the total coins which you want to exchange.<br><a href='javascript:history.back()'>Back</a>";
	} elseif($_POST['curcoins'] > $coins_max) {
		echo "<br>Coins The specified number is greater than the sum of the maximum you can currently afford.<br><a href='javascript:history.back()'>Back</a>";
	} else {

		$mmoney = $_POST['curcoins']*$dil_coins;
		$rand = rand(1,2);
		if($rand == '1') {
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$_POST['curcoins']." WHERE user_no = '".$user_no."'",$ms_con);
		} else {
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$_POST['curcoins']." WHERE user_no = '".$user_no."'",$ms_con);
		}
		mssql_query("UPDATE character.dbo.user_character SET dwMoney = dwMoney-$mmoney WHERE character_no = '".$char_no."'",$ms_con);

		$coins_add = preg_replace("{COINS}",$_POST['curcoins'],"Your account has been successfully COINS coins added.");

		echo "<br>".$coins_add;

	}
} else {
	echo "<br>This function does not exist.";
}

?>

