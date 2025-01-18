
<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?do=armor&id=".$id."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='center'><img src='images/content/content_send_armor.png' valign='left'><br></td>
				</tr>
				<tr>
					<td colspan='2' align='center'>&nbsp;</td>
				</tr>
				<tr>
					<td align='center'>Character Name</td>
					<td><input type='text' name='charname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='hidden' name='select' value='1'>
						<input type='submit' value='Select Armor'>
					</td>
				</tr>
			</table>
		</form></center>";
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Go Back</a>";
		} elseif($count > '1') {
			echo "<br>There were several characters with this name is found. <br>Please check that name in the database<br><a href='javascript:history.back()'>Go Back</a>";
		} else {
			$result2 = mssql_query("SELECT user_no,character_no,byPCClass FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);
			echo "<center><br><form action='?do=armor&id=".$id."' method='POST'>
				<table class='innertab'>
					<tr>
						<td align='center'>Selected character :</td>
						<td align='center'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Level range</td>
						<td align='center'><select name='min_max' class='input'>
								<option value='1_30' selected>Lv 1 - Lv 30</option>
								<option value='30_50'>Lv 30 - Lv 50</option>
								<option value='50_80'>Lv 50 - Lv 80</option>
								<option value='80_100'>Lv 80 - Lv 100</option>
								<option value='100_130'>Lv 100 - Lv 130</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Armor Type</td>
						<td align='center'><select name='item_type' class='input'>
								<option value='1' selected>Armor</option>
								<option value='0'>Helmet</option>
								<option value='2'>Pants</option>
								<option value='3'>Boots</option>
								<option value='4'>Gloves</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center'>Class</td>
						<td align='center'><select name='item_class' class='input'>";
								if($row2[2] == '0') {
									echo "<option value='0_0' selected>Azure Knight</option>";
								} else {
									echo "<option value='0_0'>Azure Knight</option>";
								}
								if($row2[2] == '1') {
									echo "<option value='0_1' selected>Segita Hunter</option>";
								} else {
									echo "<option value='0_1'>Segita Hunter</option>";
								}
								if($row2[2] == '2') {
									echo "<option value='0_2' selected>Incar Magician</option>";
								} else {
									echo "<option value='0_2'>Incar Magician</option>";
								}
								if($row2[2] == '3') {
									echo "<option value='0_3' selected>Vicious Summoner</option>";
								} else {
									echo "<option value='0_3'>Vicious Summoner</option>";
								}
								if($row2[2] == '4') {
									echo "<option value='1_0' selected>Segnale</option>";
								} else {
									echo "<option value='1_0'>Segnale</option>";
								}
								if($row2[2] == '5') {
									echo "<option value='1_1' selected>Bagi Warrior</option>";
								} else {
									echo "<option value='1_1'>Bagi Warrior</option>";
								}
						echo "</select>
						</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td align='center' colspan='2'>
							<input type='hidden' name='select' value='2'>
							<input type='hidden' name='char_no' value='".$row2[1]."'>
							<input type='hidden' name='charname' value='".$_POST['charname']."'>
							<input type='submit' value='Show Available Armor'>
						</td>
					</tr>
				</table>
			</form>
		</center>";
		}
	} elseif($_POST['select'] == '2') {
		list($minlv,$maxlv) = explode("_",$_POST['min_max']);

		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

		$result1 = mssql_query("SELECT Name,Job FROM osds.dbo.itemarmor WHERE ReqLv >= '".$minlv."' AND ReqLv <= '".$maxlv."' AND Name NOT LIKE '%+%' AND Code = '".$_POST['item_type']."'",$ms_con);

		echo "<center><br><form action='?do=armor&id=".$id."' method='POST'>
			<table class='innertab'>
				<tr>
					<td align='center'>Selected character :</td>
					<td align='center'><input type='text' name='charname' maxlength='20' value='".$_POST[charname]."' readonly='readonly' size='20'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>&nbsp;</td>
				</tr>
				<tr>
					<td align='center'>Available armor</td>
					<td align='center'><select name='item_name' class='input'>";
					$count = explode("_",$_POST['item_class']);
					while($row1 = mssql_fetch_row($result1)) {
						$job = explode("-",$row1[1]);
						$job_count = $job[$count[0]];
						if($job_count[$count[1]] == '1') {
							echo "<option value='".$row1[0]."'>".$row1[0]."</option>";
						}
					}
						echo "</select>
					</td>
				</tr>
				<tr>
					<td align='center' colspan='2'>&nbsp;</td>
				</tr>
				<tr>
					<td align='center'>Should be the weapon + ?</td>
					<td align='center'><select name='how_plus' class='input'>
							<option value='0' selected>0</option>
							<option value='1'>+ 1</option>
							<option value='2'>+ 2</option>
							<option value='3'>+ 3</option>
							<option value='4'>+ 4</option>
							<option value='5'>+ 5</option>
							<option value='6'>+ 6</option>
							<option value='7'>+ 7</option>
							<option value='8'>+ 8</option>
							<option value='9'>+ 9</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align='center' colspan='2'>&nbsp;</td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='hidden' name='select' value='3'>
						<input type='hidden' name='char_no' value='".$_POST['char_no']."'>
						<input type='hidden' name='class' value='".$_POST['item_class']."'>
						<input type='hidden' name='charname' value='".$_POST['charname']."'>
						<input type='submit' value='Send selected armor to character'>
					</td>
				</tr>
			</table>
		</form></center>";
	} elseif($_POST['select'] == '3') {

		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		if($_POST['how_plus'] == '0') {
			$result1 = mssql_query("SELECT ItemId FROM osds.dbo.itemarmor WHERE Name = '".$_POST['item_name']."'",$ms_con);
		} else {
			$result1 = mssql_query("SELECT ItemId FROM osds.dbo.itemarmor WHERE Name = '".$_POST['item_name']." +".$_POST['how_plus']."'",$ms_con);
		}
		$row1 = mssql_fetch_row($result1);

		if(empty($row1[0]) || $row1[0] == '0') {
			echo "<br>Either there is the desired armor with the + is not required or there is an error in the database.";
		} else {
// Feel free to change this if you want

			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
			mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".$_POST['char_no']."','".$gm_name."',1,'A armor for you','A GM has send a armor for you. \ Have fun with this armor.','".$row1[0]."',0,0",$ms_con);

			echo "<br>The selected armor has been sent successfully.";

		}

	} else {
		echo "<br><img src='images/error_action.png'>";
	}
} else {
	echo "<br><img src='images/error_access.png'>";
}

?>
</center>