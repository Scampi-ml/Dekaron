<center>
<?php
$file = 'banchar';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {

	echo "<br>
		<b><u>".$language['head1']."</b></u><br>
		<br><a href='?function=banchar&sid=list&uc=".$uc."' target='_self'>".$language['head2']."</a> | <a href='?function=banchar&sid=ban&uc=".$uc."' target='_self'>".$language['head3']."</a> | <a href='?function=banchar&sid=unban&uc=".$uc."' target='_self'>".$language['head4']."</a><br><br><br>";

	if($_GET['sid'] == 'list') {
		$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);
		$result = mysql_query("SELECT `charactername`,`reason` FROM `".$mysql['data']."`.`banned` WHERE `charactername` NOT LIKE '0'",$my_con);
		echo "<br><table class='innertab'>
			<tr>
				<td colspan='2' align='center'><b><u>".$language['head2']."</b></u></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>".$language['split1']."</td>
				<td align='center'>".$language['split2']."</td>
			</tr>";
			
		while($row = mysql_fetch_row($result)) {
			echo "<tr>
				<td align='center'>".$row[0]."</td>
				<td align='right'>".$row[1]."</td>
			</tr>";
		}
		echo "</table>";

	} elseif($_GET['sid'] == 'ban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banchar&sid=ban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head3']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split1']."</td>
						<td><input type='text' name='charname' maxlength='20'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split3']."</td>
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
			$result = mssql_query("SELECT login_flag FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);

			if($count1 < '1') {
				echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($count > '1') {
				echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($row[0] == 'N') {
				echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['reason'])) {
				echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'N' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mysql_query("INSERT INTO `".$mysql['data']."`.`banned` (`charactername`,`reason`) VALUES ('".$_POST['charname']."','".$_POST['reason']."')",$my_con);

				echo "<br>".$language['ready1'];
			}
		} else {
			echo "<br>".$language['s_error1'];
		}

	} elseif($_GET['sid'] == 'unban') {

		if(empty($_POST['select'])) {

			echo "<center><br><form action='?function=banchar&sid=unban&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head4']."</b></u></td>
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
				echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($count > '1') {
				echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif($row[0] == 'Y') {
				echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} else {
				mssql_query("UPDATE character.dbo.user_character SET login_flag = 'Y' WHERE character_name = '".$_POST['charname']."'",$ms_con);
				mysql_query("DELETE FROM `".$mysql['data']."`.`banned` WHERE `charactername` = '".$_POST['charname']."'",$my_con);

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