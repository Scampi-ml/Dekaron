<center>
<?php

$dil_coins = '10000'; //xxxxx DIL = 1 Coin

$file = 'coins';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if(empty($_POST['select'])) {
	echo "<center><form action='?function=coins&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='2' align='center'><b><u>".$language['head1']."</u></b></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>".$language['split1']."</td>
				<td><select name='charname_maxcoins'>";
					$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
					$result = mssql_query("SELECT character_no,character_name,dwMoney FROM character.dbo.user_character WHERE user_no = '".$user_no."'",$ms_con);

					while($row = mssql_fetch_row($result)) {
						$coins = $row[2]/$dil_coins;
						$coins = explode(".",$coins);
						$names_coins = preg_replace("{NAME}",$row[1],$language['select1']);
						$names_coins = preg_replace("{COINS}",$coins[0],$names_coins);
						echo "<option value='".$row[0]."_".$coins[0]."'>".$names_coins."</option>";
					}
				echo "</select></td>
			</tr>
			<tr>
				<td align='center'>".$language['split2']."</td>
				<td align='center'><input type='text' name='curcoins' maxlength='6'></td>
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
	$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$user_no."'",$ms_con);
	$row1 = mssql_fetch_row($result1);

	list($char_no,$coins_max) = explode("_",$_POST['charname_maxcoins']);

	if($row1[0] == '1100') {
		echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(!preg_match("/[0-9]?/",$_POST['curcoins'])) {
		echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif($_POST['curcoins'] > $coins_max) {
		echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} else {

		$mmoney = $_POST['curcoins']*$dil_coins;
		$rand = rand(1,2);
		if($rand == '1') {
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$_POST['curcoins']." WHERE user_no = '".$user_no."'",$ms_con);
		} else {
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$_POST['curcoins']." WHERE user_no = '".$user_no."'",$ms_con);
		}
		mssql_query("UPDATE character.dbo.user_character SET dwMoney = dwMoney-$mmoney WHERE character_no = '".$char_no."'",$ms_con);

		$coins_add = preg_replace("{COINS}",$_POST['curcoins'],$language['ready1']);

		echo "<br>".$coins_add;

	}
} else {
	echo "<br>".$language['s_error1'];
}

?>

