<center>
<?php
$file = 'teleport';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
include("../config/map.conf.php");
if($is_gm != '0') {
	if(empty($_POST['select'])) {
			echo "<center><br><form action='?function=teleport&uc=".$uc."' method='POST'>
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

			$mapcount = count($maps);
			$i = '0';

			$result2 = mssql_query("SELECT user_no,character_no,wPosX,wPosY,wMapIndex FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?function=teleport&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='center'><b><u>".$language['head1']."</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='center'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>".$language['split2']."</td>
						<td align='center'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='center'><font color='#FF0000'><b>".$language['split3']."</b></font></td>
						<td align='center'><select name='tele_way_1' class='input'>
								<option value='1' selected>".$language['select1']."</option>
								<option value='2'>".$language['select2']."</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center'><font color='#FF0000'><b>".$language['split4']."</b></font></td>
						<td align='center'><select name='tele_way_2' class='input'>
									<option value='1' selected>".$language['select3']."</option>
									<option value='2'>".$language['select4']."</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>".$language['split5']."</td>
					</tr>
					<tr>
						<td align='center'>".$language['split6']."</td>
						<td align='center'><select name='tele_map' class='input'>";
						$i = '0';
						for($i >= '0';$i < $mapcount;) {
							if($row2[4] == $maps[$i][0]) {
								echo "<option value='".$i."' selected>".$maps[$i][1]."</option>";
							} else {
								echo "<option value='".$i."'>".$maps[$i][1]."</option>";
							}
							$i++;
						}
						echo "</select></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>".$language['split7']."</td>
					</tr>
					<tr>
						<td align='center'>".$language['split8']."</td>
						<td align='center'><input type='text' name='tele_to_map' maxlength='20' value='".$row2[4]."' size='20'></td>
					</tr>
					<tr>
						<td align='center'>".$language['split9']."</td>
						<td align='center'><input type='text' name='tele_to_x' maxlength='5' value='".$row2[2]."' size='7'> / <input type='text' name='tele_to_y' maxlength='3' value='".$row2[3]."' size='7'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[1]."'>
							<input type='hidden' name='user_no' value='".$row2[0]."'>
							<input type='hidden' name='charname' value='".$_POST['charname']."'>
							<input type='submit' value='".$language['button2']."'>
						</td>
					</tr>
				</table>
			</form>";

			$text1 = preg_replace("{SELECT1}",$language['select1'],$language['text1']);
			$text1 = preg_replace("{SELECT2}",$language['select2'],$text1);
			$text1 = preg_replace("{SELECT3}",$language['select3'],$text1);
			$text1 = preg_replace("{SELECT4}",$language['select4'],$text1);

			$text2 = preg_replace("{SELECT1}",$language['select1'],$language['text2']);
			$text2 = preg_replace("{SELECT2}",$language['select2'],$text2);
			$text2 = preg_replace("{SELECT3}",$language['select3'],$text2);
			$text2 = preg_replace("{SELECT4}",$language['select4'],$text2);

			echo "<table class='innertab'>
				<tr>
					<td align='center' valign='top' width='50'>".$language['split3']."</td>
					<td valign='top'>".$text1."</td>
				</tr>
				<tr>
					<td align='center' valign='top' width='50'>".$language['split4']."</td>
					<td valign='top'>".$text2."</td>
				</tr>
			</table>
		</center>";
		}
	} elseif($_POST['select'] == '2') {

		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$_POST['user_no']."'",$ms_con);
		$row1 = mssql_fetch_row($result1);
		if($row1[0] == '1100') {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE user_no = '".$_POST['user_no']."' ORDER by login_time DESC",$ms_con);
			$row2 = mssql_fetch_row($result2);
		}

		$error4 = preg_replace("{SELECT1}",$language['select1'],$language['error4']);
		$error4 = preg_replace("{SELECT2}",$language['select2'],$error4);
		$error4 = preg_replace("{SELECT3}",$language['select3'],$error4);
		$error4 = preg_replace("{SELECT4}",$language['select4'],$error4);

		if($row1[0] == '1100' && $row2[0] == $_POST['char_no']) {
			echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_1'] == '1' && $_POST['tele_way_2'] == '2') {
			echo "<br>".$error4."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_2'] == '2' && empty($_POST['tele_to_x']) || $_POST['tele_way_2'] == '2' && empty($_POST['tele_to_y'])) {
			echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_2'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_x']) || $_POST['tele_way_2'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_y'])) {
			echo "<br>".$language['error6']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_2'] == '2' && $_POST['tele_to_x'] > '500' || $_POST['tele_way_2'] == '2' && $_POST['tele_to_y'] > '500') {
			echo "<br>".$language['error7']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_1'] == '2' && empty($_POST['tele_to_map'])) {
			echo "<br>".$language['error8']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_1'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_map'])) {
			echo "<br>".$language['error9']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['tele_way_1'] == '2' && in_array($_POST['tele_to_map'],$mapids) || $_POST['tele_way_2'] == '2' && $_POST['tele_to_y'] > '500') {
			echo "<br>".$language['error10']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} else {
	
			if($_POST['tele_way_1'] == '1') {
				$map_id = $maps[$_POST['tele_map']][0];
			} else {
				$map_id = $_POST['tele_to_map'];
			}

			if($_POST['tele_way_2'] == '1') {
				$map_x = $maps[$_POST['tele_map']][2];
				$map_y = $maps[$_POST['tele_map']][3];
			} else {
				$map_x = $_POST['tele_to_x'];
				$map_y = $_POST['tele_to_y'];
			}

			mssql_query("UPDATE 
					character.dbo.user_character
				SET 
					wPosX = '".$map_x."',
					wPosY = '".$map_y."',
					wMapIndex = '".$map_id."'
				WHERE
					character_no = '".$_POST['char_no']."'
				AND
					user_no = '".$_POST['user_no']."'
				",$ms_con);

			$ready1 = preg_replace("{CHARACTERNAME}",$_POST['charname'],$language['ready1']);
			$ready1 = preg_replace("{MAPID}",$map_id,$ready1);
			$ready1 = preg_replace("{MAPPOSX}",$map_x,$ready1);
			$ready1 = preg_replace("{MAPPOSY}",$map_y,$ready1);

			echo "<br>".$ready1;

		}
	} else {
		echo "<br>".$language['s_error1'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>