<center>
<?php
$file = 'banacc';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {

	echo "<br>
		<b><u>".$language['head1']."</b></u><br>
		<br><a href='?function=banacc&sid=list&uc=".$uc."' target='_self'>".$language['head2']."</a> | <a href='?function=banacc&sid=ban&uc=".$uc."' target='_self'>".$language['head3']."</a> | <a href='?function=banacc&sid=unban&uc=".$uc."' target='_self'>".$language['head4']."</a><br><br><br>";

	if($_GET['sid'] == 'list') {
		$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
		$result = mysql_query("SELECT `accountname`,`reason` FROM `".$mysql['data']."`.`banned` WHERE `accountname` NOT LIKE '0'",$my_con);
		echo "<br><table class='innertab'>
			<tr>
				<td colspan='2' align='center'><b><u>".$language['head2']."</b></u></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>".$language['split1']."</td>
				<td align='center'>".$language['split2']."</td></tr>";
			
		while($row = mysql_fetch_row($result)) {
			echo "<tr>
				<td align='center'>".$row[0]."</td>
				<td align='right'>".$row[1]."</td>
			</tr>";
		}
		echo "</table>";

	} elseif($_GET['sid'] == 'ban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banacc&sid=ban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head3']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split1']."</td>
						<td><input type='text' name='accountname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'><b>".$language['split3']."</b></td>
					</tr>
					<tr>
						<td align='center'>".$language['split4']."</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split5']."</td>
							<td><input type='text' name='reason' maxlength='255'></td>
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
			$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
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
				echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($count > '1') {
				echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($row[0] == 'N') {
				echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['reason'])) {
				echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} else {
				mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'N' WHERE user_id = '".$accountname."'",$ms_con);
				mysql_query("INSERT INTO `".$mysql['data']."`.`banned` (`accountname`,`reason`) VALUES ('".$accountname."','".$_POST['reason']."')",$my_con);

				echo "<br>".$language['ready1'];
			}
		} else {
			echo "<br>".$language['s_error1'];
		}

	} elseif($_GET['sid'] == 'unban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banacc&sid=unban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head4']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split1']."</td>
						<td><input type='text' name='accountname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='1'>
							<input type='submit' value='".$language['button2']."'>
						</td>
					</tr>
				</table>
			</form></center>";

		} elseif($_POST['select'] == '1') {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
			$result = mssql_query("SELECT login_tag FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accountname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($count > '1') {
				echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($row[0] == 'Y') {
				echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} else {
				mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'Y' WHERE user_id = '".$_POST['accountname']."'",$ms_con);
				mysql_query("DELETE FROM `".$mysql['data']."`.`banned` WHERE `accountname` = '".$_POST['accountname']."'",$my_con);

				echo "<br>".$language['ready2'];
			}
		} else {
			echo "<br>".$language['s_error1'];
		}		
	} else {
		echo "<br>".$language['s_error3'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>