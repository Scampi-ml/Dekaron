<center>
<?php
$file = 'character';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=character&uc=".$uc."' method='POST'>
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
			$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior"); 
			$result2 = mssql_query("SELECT character_no,user_no,dwExp,dwMoney,dwStoreMoney,wStr,wDex,wCon,wSpr,wRetPosX,wRetPosY,wRetMapIndex,wStatPoint,wSkillPoint,wLevel,byPCClass,wPKCount,wChaoticLevel,dwPVPPoint,wWinRecord,wLoseRecord,wDrawRecord FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?function=character&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='3' align='center'><b><u>".$language['head1']."</b></u></td>
					</tr>
					<tr>
						<td colspan='3' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split2']."</td>
						<td align='center'>".$language['split3']."</td>
						<td align='center'>".$language['split4']."</td>
					</tr>
					<tr>
						<td align='center'>".$language['split1']."</td>
						<td align='center'>".$_POST[charname]."</td>
						<td align='center'><input type='text' name='new_charname' maxlength='20' value='".$_POST[charname]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split5']."</td>
						<td align='center'>".$row2[2]."</td>
						<td align='center'><input type='text' name='new_exp' maxlength='20' value='".$row2[2]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split6']."</td>
						<td align='center'>".$row2[14]."</td>
						<td align='center'><input type='text' name='new_lvl' maxlength='20' value='".$row2[14]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split7']."</td>
						<td align='center'>".$classes[$row2[15]]."</td>
						<td align='center'><select name='new_class' class='input'>";
								if($row2[15] == '0') {
									echo "<option value='0' selected>Azure Knight</option>";
								} else {
									echo "<option value='0'>Azure Knight</option>";
								}
								if($row2[15] == '1') {
									echo "<option value='1' selected>Segita Hunter</option>";
								} else {
									echo "<option value='1'>Segita Hunter</option>";
								}
								if($row2[15] == '2') {
									echo "<option value='2' selected>Incar Magician</option>";
								} else {
									echo "<option value='2'>Incar Magician</option>";
								}
								if($row2[15] == '3') {
									echo "<option value='3' selected>Vicious Summoner</option>";
								} else {
									echo "<option value='3'>Vicious Summoner</option>";
								}
								if($row2[15] == '4') {
									echo "<option value='4' selected>Segnale</option>";
								} else {
									echo "<option value='4'>Segnale</option>";
								}
								if($row2[15] == '5') {
									echo "<option value='5' selected>Bagi Warrior</option>";
								} else {
									echo "<option value='5'>Bagi Warrior</option>";
								}
						echo "</select>
						</td>
					</tr>
					<tr>
						<td align='center'>".$language['split8']."</td>
						<td align='center'>".$row2[5]."</td>
						<td align='center'><input type='text' name='new_str' maxlength='20' value='".$row2[5]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split9']."</td>
						<td align='center'>".$row2[6]."</td>
						<td align='center'><input type='text' name='new_dex' maxlength='20' value='".$row2[6]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split10']."</td>
						<td align='center'>".$row2[7]."</td>
						<td align='center'><input type='text' name='new_con' maxlength='20' value='".$row2[7]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split11']."</td>
						<td align='center'>".$row2[8]."</td>
						<td align='center'><input type='text' name='new_spr' maxlength='20' value='".$row2[8]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split12']."</td>
						<td align='center'>".$row2[3]."</td>
						<td align='center'><input type='text' name='new_inv_money' maxlength='20' value='".$row2[3]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split13']."</td>
						<td align='center'>".$row2[4]."</td>
						<td align='center'><input type='text' name='new_war_money' maxlength='20' value='".$row2[4]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split14']."</td>
						<td align='center'>".$row2[9]."</td>
						<td align='center'><input type='text' name='new_ret_x' maxlength='20' value='".$row2[9]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split15']."</td>
						<td align='center'>".$row2[10]."</td>
						<td align='center'><input type='text' name='new_ret_y' maxlength='20' value='".$row2[10]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split16']."</td>
						<td align='center'>".$row2[11]."</td>
						<td align='center'><select name='new_ret_map' class='input'>";
								if($row2[11] == '7') {
									echo "<option value='7' selected>Loa Castle</option>";
								} else {
									echo "<option value='7'>Loa Castle</option>";
								}
								if($row2[11] == '0') {
									echo "<option value='0' selected>Braiken Castle</option>";
								} else {
									echo "<option value='0'>Braiken Castle</option>";
								}
					echo "</select></td>
					</tr>
					<tr>
						<td align='center'>".$language['split17']."</td>
						<td align='center'>".$row2[12]."</td>
						<td align='center'><input type='text' name='new_stats' maxlength='20' value='".$row2[12]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split18']."</td>
						<td align='center'>".$row2[13]."</td>
						<td align='center'><input type='text' name='new_skill' maxlength='20' value='".$row2[13]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split19']."</td>
						<td align='center'>".$row2[18]."</td>
						<td align='center'><input type='text' name='new_pvp_t' maxlength='20' value='".$row2[18]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split20']."</td>
						<td align='center'>".$row2[19]."</td>
						<td align='center'><input type='text' name='new_pvp_w' maxlength='20' value='".$row2[19]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split21']."</td>
						<td align='center'>".$row2[20]."</td>
						<td align='center'><input type='text' name='new_pvp_l' maxlength='20' value='".$row2[20]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split22']."</td>
						<td align='center'>".$row2[21]."</td>
						<td align='center'><input type='text' name='new_pvp_d' maxlength='20' value='".$row2[21]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split23']."</td>
						<td align='center'>".$row2[16]."</td>
						<td align='center'><input type='text' name='new_pk' maxlength='20' value='".$row2[16]."'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split24']."</td>
						<td align='center'>".$row2[17]."</td>
						<td align='center'><input type='text' name='new_chaotic' maxlength='20' value='".$row2[17]."'></td>
					</tr>
					<tr>
						<td align='center' colspan='3'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[0]."'>
							<input type='hidden' name='user_no' value='".$row2[1]."'>
							<input type='hidden' name='char_name' value='".$_POST['charname']."'>
							<input type='submit' value='".$language['button1']."'>
						</td>
					</tr>
				</table>
			</form></center>";
		}
	} elseif($_POST['select'] == '2') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$_POST['user_no']."'",$ms_con);
		$row1 = mssql_fetch_row($result1);
		if($row1[0] == '1100') {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE user_no = '".$_POST['user_no']."' ORDER by login_time DESC",$ms_con);
			$row2 = mssql_fetch_row($result2);
		}

		$allpvp = $_POST['new_pvp_w']+$_POST['new_pvp_l']+$_POST['new_pvp_d'];

		if($row1[0] == '1100' && $row2[0] == $_POST['char_no']) {
			echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/^[0-9a-zA-Z\-\[\]\_]{6,12}$/i", $_POST['new_charname'])) {
			echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_exp'])) {
			echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_lvl'])) {
			echo "<br>".$language['error6']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_str'])) {
			echo "<br>".$language['error7']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_dex'])) {
			echo "<br>".$language['error8']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_con'])) {
			echo "<br>".$language['error9']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_spr'])) {
			echo "<br>".$language['error10']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_inv_money'])) {
			echo "<br>".$language['error11']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_war_money'])) {
			echo "<br>".$language['error12']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_ret_x'])) {
			echo "<br>".$language['error13']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_ret_y'])) {
			echo "<br>".$langauage['error14']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_stats'])) {
			echo "<br>".$language['error15']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_skill'])) {
			echo "<br>".$language['error16']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_pvp_t']) || !preg_match("/^[0-9]$/i", $_POST['new_pvp_w']) || !preg_match("/^[0-9]$/i", $_POST['new_pvp_l']) || !preg_match("/^[0-9]$/i", $_POST['new_pvp_d'])) {
			echo "<br>".$language['error17']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($allpvp != $_POST['new_pvp_t']) {
			echo "<br>".$language['error18']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_pk'])) {
			echo "<br>".$language['error19']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_chaotic'])) {
			echo "<br>".$language['error20']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} else {
			mssql_query("UPDATE
					character.dbo.user_character 
				SET
					character_name = '".$_POST['new_charname']."',
					dwExp = '".$_POST['new_exp']."',
					dwMoney = '".$_POST['new_inv_money']."',
					dwStoreMoney = '".$_POST['new_war_money']."',
					wStr = '".$_POST['new_str']."',
					wDex = '".$_POST['new_dex']."',
					wCon = '".$_POST['new_con']."',
					wSpr = '".$_POST['new_spr']."',
					wRetPosX = '".$_POST['new_ret_x']."',
					wRetPosY = '".$_POST['new_ret_y']."',
					wRetMapIndex = '".$_POST['new_ret_map']."',
					wStatPoint = '".$_POST['new_stats']."',
					wSkillPoint = '".$_POST['new_skill']."',
					wLevel = '".$_POST['new_lvl']."',
					byPCClass = '".$_POST['new_class']."',
					wPKCount = '".$_POST['new_pk']."',
					wChaoticLevel = '".$_POST['new_chaotic']."',
					dwPVPPoint = '".$_POST['new_pvp_t']."',
					wWinRecord = '".$_POST['new_pvp_w']."',
					wLoseRecord = '".$_POST['new_pvp_l']."',
					wDrawRecord = '".$_POST['new_pvp_d']."'
				WHERE
					character_no = '".$_POST['char_no']."'",$ms_con);

			echo "<br>".$language['ready1'];
		}
	} else {
		echo "<br>".$language['s_error1'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>