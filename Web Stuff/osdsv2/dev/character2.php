<?php

 $char_no = $_GET['char_no'];


 $classes = array('0' => "Azure Knight", 
                  '1' => "Segita Hunter", 
				  '2' => "Incar Magician", 
				  '3' => "Vicious Summoner", 
				  '4' => "Segnale", 
				  '5' => "Bagi Warrior",
				  '6' => "Aloken"
				  ); 
				  
 $statreset = array('0' => "Unused", 
 					'1' => "Used"
				  ); 
				  
 $skillreset = array('0' => "Unused", 
                     '1' => "Used"
				  ); 

if(empty($_POST['select'])) {

			$query = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_no = '$char_no'");
			$row2 = mssql_fetch_array($query);
		echo "<center><br><form action='' method='POST'>
				<table width='600' class='innertab'>
					<tr>
						<td align='left'><b>Type</b></td>
						<td align='left'><b>Current Stats</b></td>
						<td align='left'><b>New Stats</b></td>
					</tr>
					<tr>
						<td align='left'>User No</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$row2["user_no"]."</td>
					</tr>

					<tr>
						<td align='left'>Character Name</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$row2["character_name"]."</td>
					</tr>
					<tr>
						<td align='left'>Experience</td>
						<td align='left'>".$row2["dwExp"]."</td>
						<td align='left'><input type='text' name='new_exp' maxlength='20' value='".$row2["dwExp"]."'></td>
					</tr>
						<tr>
						<td align='left'>Adv</td>
						<td align='left'>".$row2["dwAdv"]."</td>
						<td align='left'><input type='text' name='new_adv' maxlength='20' value='".$row2["dwAdv"]."'></td>
					</tr>
						<tr>
						<td align='left'>Hp</td>
						<td align='left'>".$row2["nHP"]."</td>
						<td align='left'><input type='text' name='new_hp' maxlength='20' value='".$row2["nHP"]."'></td>
					</tr>
						<tr>
						<td align='left'>Mp</td>
						<td align='left'>".$row2["nMP"]."</td>
						<td align='left'><input type='text' name='new_mp' maxlength='20' value='".$row2["nMP"]."'></td>
					</tr>
					<tr>
						<td align='left'>Level</td>
						<td align='left'>".$row2["wLevel"]."</td>
						<td align='left'><input type='text' name='new_lvl' maxlength='20' value='".$row2["wLevel"]."'></td>
					</tr>
					<tr>
						<td align='left'>Class</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$classes[$row2["byPCClass"]]."</td>
					</tr>
					<tr>
						<td align='left'>Str points</td>
						<td align='left'>".$row2["wStr"]."</td>
						<td align='left'><input type='text' name='new_str' maxlength='20' value='".$row2["wStr"]."'></td>
					</tr>
					<tr>
						<td align='left'>Dex points</td>
						<td align='left'>".$row2["wDex"]."</td>
						<td align='left'><input type='text' name='new_dex' maxlength='20' value='".$row2["wDex"]."'></td>
					</tr>
					<tr>
						<td align='left'>Con points</td>
						<td align='left'>".$row2["wCon"]."</td>
						<td align='left'><input type='text' name='new_con' maxlength='20' value='".$row2["wCon"]."'></td>
					</tr>
					<tr>
						<td align='left'>Spr points</td>
						<td align='left'>".$row2["wSpr"]."</td>
						<td align='left'><input type='text' name='new_spr' maxlength='20' value='".$row2["wSpr"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Inventory</td>
						<td align='left'>".$row2["dwMoney"]."</td>
						<td align='left'><input type='text' name='new_inv_money' maxlength='20' value='".$row2["dwMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Warehouse</td>
						<td align='left'>".$row2["dwStorageMoney"]."</td>
						<td align='left'><input type='text' name='new_war_money' maxlength='20' value='".$row2["dwStorageMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Shop</td>
						<td align='left'>".$row2["dwStoreMoney"]."</td>
						<td align='left'><input type='text' name='new_inv_money' maxlength='20' value='".$row2["dwStoreMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>Current Map</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$row2["wMapIndex"]."</td>
					</tr>
					<tr>
						<td align='left'>Stats points</td>
						<td align='left'>".$row2["wStatPoint"]."</td>
						<td align='left'><input type='text' name='new_stats' maxlength='20' value='".$row2["wStatPoint"]."'></td>
					</tr>
					<tr>
						<td align='left'>Skill points</td>
						<td align='left'>".$row2["wSkillPoint"]."</td>
						<td align='left'><input type='text' name='new_skill' maxlength='20' value='".$row2["wSkillPoint"]."'></td>
					</tr>
					<tr>
						<td align='left'>Skill Reset</td>
						<td align='left'>".$skillreset[$row2["byStatClearCount"]]."</td>
						<td align='left'><select name='new_skillreset' class='input'>";
								if($row2["byStatClearCount"] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row2["byStatClearCount"] == '0') {
									echo "<option value='0' selected>Unused</option>";
								} else {
									echo "<option value='0'>Unused</option>";
								}

					echo "</select></td>
					</tr>

						<tr>
						<td align='left'>Stats Reset</td>
						<td align='left'>".$statreset[$row2["bySkillClearCount"]]."</td>
						<td align='left'><select name='new_statreset' class='input'>";
								if($row2["bySkillClearCount"] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row2["bySkillClearCount"] == '0') {
									echo "<option value='0' selected>Unused</option>";
								} else {
									echo "<option value='0'>Unused</option>";
								}

					echo "</select></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
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
	} elseif($_POST['select'] == '2') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		
		$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$_POST['user_no']."'",$ms_con);
		$row1 = mssql_fetch_row($result1);
		if($row1[0] == '1100') {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE user_no = '".$_POST['user_no']."' ORDER by login_time DESC",$ms_con);
			$row2 = mssql_fetch_row($result2);
		}

		if($row1[0] == '1100' && $row2[0] == $_POST['char_no']) {
			echo "<br>This character can not currently be edited, since it is online.<br><a href='javascript:history.back()'>Go Back</a>";
			echo "<br>The new character's name is not just letters and numbers or is shorter than 3 characters or longer than 20 characters.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_exp'])) {
			echo "<br>Experience does not only consist of numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_lvl'])) {
			echo "<br>The level indication does not only consist of numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_str'])) {
			echo "<br>The data points Str consists not only of numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_dex'])) {
			echo "<br>The Dex data points is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_con'])) {
			echo "<br>The Con data points is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_spr'])) {
			echo "<br>The Spr data points is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_inv_money'])) {
			echo "<br>The new DIL Inventory consists not only of numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_war_money'])) {
			echo "<br>The new DIL Warehouse does not only consist of numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_stats'])) {
			echo "<br>The stats point is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_skill'])) {
			echo "<br>The skill points is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_skillreset'])) {
			echo "<br>Invalid Skill Reset Number Can only be 1 of 0<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_statreset'])) {
			echo "<br>Invalid Stats Reset Number Can only be 1 of 0<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_adv'])) {
			echo "<br>The Adv count is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_hp'])) {
			echo "<br>The HP count is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif(!preg_match("/[0-9]?/", $_POST['new_mp'])) {
			echo "<br>The MP count is not just numbers.<br><a href='javascript:history.back()'>Go Back</a>";





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
					wStatPoint = '".$_POST['new_statsreset']."',
					wSkillPoint = '".$_POST['new_skillreset']."',
					wLevel = '".$_POST['new_lvl']."',
					bySkillClearCount = '".$_POST['new_skillreset']."',
					byStatClearCount = '".$_POST['new_statreset']."',
					dwAdv = '".$_POST['new_adv']."',
					nHP = '".$_POST['new_hp']."',
					nMP = '".$_POST['new_mp']."',


				WHERE
					character_no = '".$_POST['char_no']."'",$ms_con);

			echo "<br>".$_POST['new_charname']." Edited!<br> Remember the changes successfully when you are new in the account has logged.";
		}
}
?>
