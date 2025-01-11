<?php
$file = 'usercharacter';
if($is_gm != '') {
if(empty($_POST['select'])) {
	echo "<center><form action='?function=usercharacter&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='2' align='left'><b><u>Character Stats</b></u></td>
			</tr>
			<tr>
				<td colspan='2' align='left'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'>Character Name</td>
				<td><select name='char_no'>";
					$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
					$result = mssql_query("SELECT character_no,character_name FROM character.dbo.user_character WHERE user_no = '".$user_no."'",$ms_con);

					while($row = mssql_fetch_row($result)) {
						echo "<option value='".$row[0]."'>".$row[1]."</option>";
					}
				echo "</select></td>
			</tr>
			<tr>
				<td align='left' colspan='2'>
					<input type='hidden' name='select' value='1'>
					<input type='submit' value='Show character stats'>
				</td>
			</tr>
		</table>
	</form></center>";		
//		------------------------------
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_no = '".$_POST['char_no']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($count > '1') {
			echo "<br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Back</a>";
		} else {
			$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior"); 
			$statreset = array('0' => "Unused", '1' => "Used"); 
			$skillreset = array('0' => "Unused", '1' => "Used"); 

			$result2 = mssql_query("SELECT character_no,user_no,dwExp,dwMoney,dwStoreMoney,wStr,wDex,wCon,wSpr,wRetPosX,wRetPosY,wRetMapIndex,wStatPoint,wSkillPoint,wLevel,byPCClass,wPKCount,wChaoticLevel,dwPVPPoint,wWinRecord,wLoseRecord,wDrawRecord,Reborn,bySkillClearCount,byStatClearCount,character_name,dwAdv FROM character.dbo.user_character WHERE character_no = '".$_POST['char_no']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?function=usercharacter&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='3' align='left'><b><u>Character Stats</b></u></td>
					</tr>
					<tr>
						<td colspan='3' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>---------- Type ----------</td>
						<td align='left'>---------- Current Stats ----------</td>
					</tr>
					<tr>
						<td align='left'>Character Name</td>
						<td align='left'>".$row2[25]."</td>
					</tr>
					<tr>
						<td align='left'>Experience</td>
						<td align='left'>".$row2[2]."</td>
					</tr>
						<tr>
						<td align='left'>Adv</td>
						<td align='left'>".$row2[26]."</td>
					</tr>
					<tr>
						<td align='left'>Level</td>
						<td align='left'>".$row2[14]."</td>
					</tr>
					<tr>
						<td align='left'>Class</td>
						<td align='left'>".$classes[$row2[15]]."</td>
					</tr>
					<tr>
						<td align='left'>Str</td>
						<td align='left'>".$row2[5]."</td>
					</tr>
					<tr>
						<td align='left'>Dex</td>
						<td align='left'>".$row2[6]."</td>
					</tr>
					<tr>
						<td align='left'>Con</td>
						<td align='left'>".$row2[7]."</td>
					</tr>
					<tr>
						<td align='left'>Spr</td>
						<td align='left'>".$row2[8]."</td>
					</tr>
					<tr>
						<td align='left'>DIL Inventory</td>
						<td align='left'>".$row2[3]."</td>
					</tr>
					<tr>
						<td align='left'>DIL Warehouse</td>
						<td align='left'>".$row2[4]."</td>
					</tr>
					<tr>
						<td align='left'>Return Pos.X</td>
						<td align='left'>".$row2[9]."</td>
					</tr>
					<tr>
						<td align='left'>Return Pos.Y</td>
						<td align='left'>".$row2[10]."</td>
					</tr>
					<tr>
						<td align='left'>Return Map</td>
						<td align='left'>".$row2[11]."</td>
					</tr>
					<tr>
						<td align='left'>Free stats points</td>
						<td align='left'>".$row2[12]."</td>
					</tr>
					<tr>
						<td align='left'>Free skill points</td>
						<td align='left'>".$row2[13]."</td>
					</tr>
					<tr>
						<td align='left'>Total PvP</td>
						<td align='left'>".$row2[18]."</td>
					</tr>
					<tr>
						<td align='left'>PvP Obtained</td>
						<td align='left'>".$row2[19]."</td>
					</tr>
					<tr>
						<td align='left'>PvP Lost</td>
						<td align='left'>".$row2[20]."</td>
					</tr>
					<tr>
						<td align='left'>PvP Draw</td>
						<td align='left'>".$row2[21]."</td>
					</tr>
					<tr>
						<td align='left'>PK points</td>
						<td align='left'>".$row2[16]."</td>
					</tr>
					<tr>
						<td align='left'>Chaotic Level (IP)</td>
						<td align='left'>".$row2[17]."</td>
					</tr>
						<tr>
						<td align='left'>Reborn</td>
						<td align='left'>".$row2[22]."</td>
					</tr>
						<tr>
						<td align='left'>Skill Reset</td>
						<td align='left'>".$skillreset[$row2[23]]."</td>
					</tr>
						<tr>
						<td align='left'>Stats Reset</td>
						<td align='left'>".$statreset[$row2[24]]."</td>
					</tr>
					<tr>
					</tr>
				</table>
			</form></center>";
		}
	} 
}

?>
</center>