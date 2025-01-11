<center>
<?php
$file = 'character';
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=character&uc=".$uc."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='left'><b><u>Change Character Stats</b></u></td>
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
						<input type='submit' value='Set new Character Stats'>
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
			echo "<br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Back</a>";
		} else {
			$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior"); 
			$statreset = array('0' => "Unused", '1' => "Used"); 
			$skillreset = array('0' => "Unused", '1' => "Used"); 


			$result2 = mssql_query("SELECT character_no,user_no,dwExp,dwMoney,dwStoreMoney,wStr,wDex,wCon,wSpr,wRetPosX,wRetPosY,wRetMapIndex,wStatPoint,wSkillPoint,wLevel,byPCClass,wPKCount,wChaoticLevel,dwPVPPoint,wWinRecord,wLoseRecord,wDrawRecord,Reborn,bySkillClearCount,byStatClearCount,dwAdv,nHP,nMP,nShield FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?function=character&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='3' align='left'><b><u>Change Character Stats</b></u></td>
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
						<td align='left'>Character Name</td>
						<td align='left'>".$_POST[charname]."</td>
						<td align='left'><input type='text' name='new_charname' maxlength='20' value='".$_POST[charname]."'></td>
					</tr>
					<tr>
						<td align='left'>Experience</td>
						<td align='left'>".$row2[2]."</td>
						<td align='left'><input type='text' name='new_exp' maxlength='20' value='".$row2[2]."'></td>
					</tr>
						<tr>
						<td align='left'>Adv</td>
						<td align='left'>".$row2[25]."</td>
						<td align='left'><input type='text' name='new_adv' maxlength='20' value='".$row2[25]."'></td>
					</tr>
						<tr>
						<td align='left'>Hp</td>
						<td align='left'>".$row2[26]."</td>
						<td align='left'><input type='text' name='new_hp' maxlength='20' value='".$row2[26]."'></td>
					</tr>
						<tr>
						<td align='left'>Mp</td>
						<td align='left'>".$row2[27]."</td>
						<td align='left'><input type='text' name='new_mp' maxlength='20' value='".$row2[27]."'></td>
					</tr>
						<tr>
						<td align='left'>Shield</td>
						<td align='left'>".$row2[28]."</td>
						<td align='left'><input type='text' name='new_shield' maxlength='20' value='".$row2[28]."'></td>
					</tr>

					<tr>
						<td align='left'>Level</td>
						<td align='left'>".$row2[14]."</td>
						<td align='left'><input type='text' name='new_lvl' maxlength='20' value='".$row2[14]."'></td>
					</tr>
					<tr>
						<td align='left'>Class</td>
						<td align='left'>".$classes[$row2[15]]."</td>
						<td align='left'><select name='new_class' class='input'>";
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
						<td align='left'>Str points</td>
						<td align='left'>".$row2[5]."</td>
						<td align='left'><input type='text' name='new_str' maxlength='20' value='".$row2[5]."'></td>
					</tr>
					<tr>
						<td align='left'>Dex points</td>
						<td align='left'>".$row2[6]."</td>
						<td align='left'><input type='text' name='new_dex' maxlength='20' value='".$row2[6]."'></td>
					</tr>
					<tr>
						<td align='left'>Con points</td>
						<td align='left'>".$row2[7]."</td>
						<td align='left'><input type='text' name='new_con' maxlength='20' value='".$row2[7]."'></td>
					</tr>
					<tr>
						<td align='left'>Spr points</td>
						<td align='left'>".$row2[8]."</td>
						<td align='left'><input type='text' name='new_spr' maxlength='20' value='".$row2[8]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Inventory</td>
						<td align='left'>".$row2[3]."</td>
						<td align='left'><input type='text' name='new_inv_money' maxlength='20' value='".$row2[3]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Warehouse</td>
						<td align='left'>".$row2[4]."</td>
						<td align='left'><input type='text' name='new_war_money' maxlength='20' value='".$row2[4]."'></td>
					</tr>
					<tr>
						<td align='left'>Return Pos.X</td>
						<td align='left'>".$row2[9]."</td>
						<td align='left'><input type='text' name='new_ret_x' maxlength='20' value='".$row2[9]."'></td>
					</tr>
					<tr>
						<td align='left'>Return Pos.Y</td>
						<td align='left'>".$row2[10]."</td>
						<td align='left'><input type='text' name='new_ret_y' maxlength='20' value='".$row2[10]."'></td>
					</tr>
					<tr>
						<td align='left'>Return Map</td>
						<td align='left'>".$row2[11]."</td>
						<td align='left'><select name='new_ret_map' class='input'>";
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
						<td align='left'>Stats points</td>
						<td align='left'>".$row2[12]."</td>
						<td align='left'><input type='text' name='new_stats' maxlength='20' value='".$row2[12]."'></td>
					</tr>
					<tr>
						<td align='left'>Skill points</td>
						<td align='left'>".$row2[13]."</td>
						<td align='left'><input type='text' name='new_skill' maxlength='20' value='".$row2[13]."'></td>
					</tr>
					<tr>
						<td align='left'>Total PvP</td>
						<td align='left'>".$row2[18]."</td>
						<td align='left'><input type='text' name='new_pvp_t' maxlength='20' value='".$row2[18]."'></td>
					</tr>
					<tr>
						<td align='left'>PvP Obtained</td>
						<td align='left'>".$row2[19]."</td>
						<td align='left'><input type='text' name='new_pvp_w' maxlength='20' value='".$row2[19]."'></td>
					</tr>
					<tr>
						<td align='left'>PvP Lost</td>
						<td align='left'>".$row2[20]."</td>
						<td align='left'><input type='text' name='new_pvp_l' maxlength='20' value='".$row2[20]."'></td>
					</tr>
					<tr>
						<td align='left'>PvP Draw</td>
						<td align='left'>".$row2[21]."</td>
						<td align='left'><input type='text' name='new_pvp_d' maxlength='20' value='".$row2[21]."'></td>
					</tr>
					<tr>
						<td align='left'>PK points</td>
						<td align='left'>".$row2[16]."</td>
						<td align='left'><input type='text' name='new_pk' maxlength='20' value='".$row2[16]."'></td>
					</tr>
					<tr>
						<td align='left'>Chaotic Level (IP)</td>
						<td align='left'>".$row2[17]."</td>
						<td align='left'><input type='text' name='new_chaotic' maxlength='20' value='".$row2[17]."'></td>
					</tr>
						<tr>
						<td align='left'>Reborn</td>
						<td align='left'>".$row2[22]."</td>
						<td align='left'><input type='text' name='new_reborn' maxlength='20' value='".$row2[22]."'></td>
					</tr>
											<tr>
						<td align='left'>Skill Reset</td>
						<td align='left'>".$skillreset[$row2[23]]."</td>
						<td align='left'><select name='new_skillreset' class='input'>";
								if($row2[23] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row2[23] == '0') {
									echo "<option value='0' selected>Unused</option>";
								} else {
									echo "<option value='0'>Unused</option>";
								}

					echo "</select></td>
					</tr>

						<tr>
						<td align='left'>Stats Reset</td>
						<td align='left'>".$statreset[$row2[24]]."</td>
						<td align='left'><select name='new_statreset' class='input'>";
								if($row2[24] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row2[24] == '0') {
									echo "<option value='0' selected>Unused</option>";
								} else {
									echo "<option value='0'>Unused</option>";
								}

					echo "</select></td>
					</tr>


					<tr>
						<td align='left' colspan='3'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[0]."'>
							<input type='hidden' name='user_no' value='".$row2[1]."'>
							<input type='hidden' name='char_name' value='".$_POST['charname']."'>
							<input type='submit' value='Set new Character Stats'>
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

		if($row1[0] == '1100' && $row2[0] == $_POST['char_no']) {
			echo "<br>This character can not currently be edited, since it is online.<br><a href='javascript:history.back()'>Back</a>";
			echo "<br>The new character's name is not just letters and numbers or is shorter than 3 characters or longer than 20 characters.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_exp'])) {
			echo "<br>Experience does not only consist of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_lvl'])) {
			echo "<br>The level indication does not only consist of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_str'])) {
			echo "<br>The data points Str consists not only of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_dex'])) {
			echo "<br>The Dex data points is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_con'])) {
			echo "<br>The Con data points is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_spr'])) {
			echo "<br>The Spr data points is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_inv_money'])) {
			echo "<br>The new DIL Inventory consists not only of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_war_money'])) {
			echo "<br>The new DIL Warehouse does not only consist of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_ret_x'])) {
			echo "<br>The new return point X is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_ret_y'])) {
			echo "<br>The new return point Y is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_stats'])) {
			echo "<br>The stats point is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_skill'])) {
			echo "<br>The skill points is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_pk'])) {
			echo "<br>The PK count is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_chaotic'])) {
			echo "<br>The Chaotic level does not only consist of numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_reborn'])) {
			echo "<br>Invalid Reborn Number<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_skillreset'])) {
			echo "<br>Invalid Skill Reset Number Can only be 1 of 0<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_statreset'])) {
			echo "<br>Invalid Stats Reset Number Can only be 1 of 0<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_adv'])) {
			echo "<br>The Adv count is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_hp'])) {
			echo "<br>The HP count is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_mp'])) {
			echo "<br>The MP count is not just numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_shield'])) {
			echo "<br>The Shield count is not just numbers.<br><a href='javascript:history.back()'>Back</a>";





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
					wStatPoint = '".$_POST['new_statsreset']."',
					wSkillPoint = '".$_POST['new_skillreset']."',
					wLevel = '".$_POST['new_lvl']."',
					byPCClass = '".$_POST['new_class']."',
					wPKCount = '".$_POST['new_pk']."',
					wChaoticLevel = '".$_POST['new_chaotic']."',
					dwPVPPoint = '".$_POST['new_pvp_t']."',
					wWinRecord = '".$_POST['new_pvp_w']."',
					wLoseRecord = '".$_POST['new_pvp_l']."',
					wDrawRecord = '".$_POST['new_pvp_d']."',
					Reborn = '".$_POST['new_reborn']."',
					bySkillClearCount = '".$_POST['new_skillreset']."',
					byStatClearCount = '".$_POST['new_statreset']."',
					dwAdv = '".$_POST['new_adv']."',
					nHP = '".$_POST['new_hp']."',
					nMP = '".$_POST['new_mp']."',
					nShield = '".$_POST['new_shield']."'


				WHERE
					character_no = '".$_POST['char_no']."'",$ms_con);

			echo "<br>".$_POST['new_charname']." Edited!<br> Remember the changes successfully when you are new in the account has logged.";
		}
	} else {
		echo "<br>This function does not exist.";
	}
} else {
	echo "<br>You are not a GM , you have no access to this function.";
}

?>
</center>