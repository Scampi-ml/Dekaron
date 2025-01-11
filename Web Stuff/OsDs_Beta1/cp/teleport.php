<center>
<?php
$file = 'teleport';
//Map Infos for Select Map
//Count , Map Id , Map Name , Map Pos. X , Map Pos. Y

$maps = array('0' => array("0","Braiken Castle","294","245"),
	'1' => array("1","North Ares","296","185"),
	'2' => array("2","Den of Norak","0","0"),
	'3' => array("3","Denebe","467","274"),
	'4' => array("6","Parca","418","324"),
	'5' => array("7","Loa Castle","275","221"),
	'6' => array("12","Crespo","136","306"),
	'7' => array("13","Draco Desert","221","193"),
	'8' => array("17","Requies Beach","46","466"),
	'9' => array("18","Avalon Island","426","373"),
	'10' => array("23","Genoa Castle","71","287"),
	'11' => array("61","Braiken Agency","255","281"),
	'12' => array("62","Loa Agency","255","281"),
	'13' => array("65","Plane of Pilgrimage","150","350"),
	'14' => array("99","Crash Map","280","220")
);


//Map IDs for check of Map exist
//Map Id , Map Id , Map Id ....
$mapids = array('0','1','2','3','5','6','7','8','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','39','40','41','42','43','44','45','46','47','48','61','62','63','64','65','66','67','68','99','100','101','102','103','104','105','106');

if($is_gm != '0') {
	if(empty($_POST['select'])) {
			echo "<center><br><form action='?function=teleport&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>Teleport Character</b></u></td>
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
							<input type='submit' value='Select Character'>
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

			$mapcount = count($maps);
			$i = '0';

			$result2 = mssql_query("SELECT user_no,character_no,wPosX,wPosY,wMapIndex FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?function=teleport&uc=".$uc."' method='POST'>
				<table class='innertab'>
					<tr>
						<td colspan='2' align='left'><b><u>Teleport Character</b></u></td>
					</tr>
					<tr>
						<td colspan='2' align='left'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left'>Selected Character</td>
						<td align='left'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='left'><font color='#FF0000'><b>Teleport art by:</b></font></td>
						<td align='left'><select name='tele_way_1' class='input'>
								<option value='1' selected>Election Map</option>
								<option value='2'>Map Id</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='left'><font color='#FF0000'><b>Position:</b></font></td>
						<td align='left'><select name='tele_way_2' class='input'>
									<option value='1' selected>Map Position</option>
									<option value='2'>Manual Pos</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='left' colspan='2'>Election Map</td>
					</tr>
					<tr>
						<td align='left'>Choose a Map</td>
						<td align='left'><select name='tele_map' class='input'>";
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
						<td align='left' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left' colspan='2'>Enter map data:</td>
					</tr>
					<tr>
						<td align='left'>Map Id</td>
						<td align='left'><input type='text' name='tele_to_map' maxlength='20' value='".$row2[4]."' size='20'></td>
					</tr>
					<tr>
						<td align='left'>X / Y Pos.</td>
						<td align='left'><input type='text' name='tele_to_x' maxlength='5' value='".$row2[2]."' size='7'> / <input type='text' name='tele_to_y' maxlength='3' value='".$row2[3]."' size='7'></td>
					</tr>
					<tr>
						<td align='left' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='left' colspan='2'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[1]."'>
							<input type='hidden' name='user_no' value='".$row2[0]."'>
							<input type='hidden' name='charname' value='".$_POST['charname']."'>
							<input type='submit' value='Set character on map'>
						</td>
					</tr>
				</table>
			</form>";

			$text1 = preg_replace("{SELECT1}","Election Map","Put it on <b>SELECT1</b> to the character on the selected map to set.<br>Put it on <b>SELECT2</b> to name a map ID.");
			$text1 = preg_replace("{SELECT2}","Map Id",$text1);
			$text1 = preg_replace("{SELECT3}","Map Position",$text1);
			$text1 = preg_replace("{SELECT4}","Manual Pos",$text1);

			$text2 = preg_replace("{SELECT1}","Election Map","Use <b>SELECT3</b> to the position in the selected map to use, works only with SELECT1.<br>Use SELECT4 to the position indicated.");
			$text2 = preg_replace("{SELECT2}","Map Id",$text2);
			$text2 = preg_replace("{SELECT3}","Map Position",$text2);
			$text2 = preg_replace("{SELECT4}","Manual Pos",$text2);

			echo "<table class='innertab'>
				<tr>
					<td align='left' valign='top' width='50'>Teleport art by:</td>
					<td valign='top'>".$text1."</td>
				</tr>
				<tr>
					<td align='left' valign='top' width='50'>Position:</td>
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

		$error4 = preg_replace("{SELECT1}","Election Map","You can not be combined SELECT2 and SELECT1 combined use, please correct this.");
		$error4 = preg_replace("{SELECT2}","Map Id",$error4);
		$error4 = preg_replace("{SELECT3}","Map Position",$error4);
		$error4 = preg_replace("{SELECT4}","Manual Pos",$error4);

		if($row1[0] == '1100' && $row2[0] == $_POST['char_no']) {
			echo "<br>This character can not currently be on a different map set, since this is online.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_1'] == '1' && $_POST['tele_way_2'] == '2') {
			echo "<br>".$error4."<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_2'] == '2' && empty($_POST['tele_to_x']) || $_POST['tele_way_2'] == '2' && empty($_POST['tele_to_y'])) {
			echo "<br>You have to Specify Map elected positions, but unfortunately you have no map positions indicated.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_2'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_x']) || $_POST['tele_way_2'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_y'])) {
			echo "<br>The map Specified positions X and Y are no figures.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_2'] == '2' && $_POST['tele_to_x'] > '500' || $_POST['tele_way_2'] == '2' && $_POST['tele_to_y'] > '500') {
			echo "<br>The map Specified positions X and Y must be 1 to 500.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_1'] == '2' && empty($_POST['tele_to_map'])) {
			echo "<br>You've forgotten to indicate a map Id.<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_1'] == '2' && !preg_match("/[0-9]?/",$_POST['tele_to_map'])) {
			echo "<br>The map id is not a number<br><a href='javascript:history.back()'>Back</a>";
		} elseif($_POST['tele_way_1'] == '2' && in_array($_POST['tele_to_map'],$mapids) || $_POST['tele_way_2'] == '2' && $_POST['tele_to_y'] > '500') {
			echo "<br>The Map Id does not exist.<br><a href='javascript:history.back()'>Back</a>";
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

			$ready1 = preg_replace("{CHARACTERNAME}",$_POST['charname'],"The character named CHARACTERNAME has been setsuccessfully to the desired Map (Map Id : MAPID , X : MAPPOSX , Y : MAPPOSY ) .");
			$ready1 = preg_replace("{MAPID}",$map_id,$ready1);
			$ready1 = preg_replace("{MAPPOSX}",$map_x,$ready1);
			$ready1 = preg_replace("{MAPPOSY}",$map_y,$ready1);

			echo "<br>".$ready1;

		}
	} else {
		echo "<br>This function does not exist.";
	}
} else {
	echo "<br>You are not a GM , you have no access to this function.";
}

?>
</center>