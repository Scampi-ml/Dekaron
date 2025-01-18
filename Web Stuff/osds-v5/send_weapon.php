<?php
include ("osdscore.php");
echo HEADER;
$GET_CHARACTER_NO = $_GET['character'];
$GET_CHARACTER_NAME = $_GET['character_name'];

echo '<div id="serverinfo">'.LAN_send.' '.LAN_weapon.' '.LAN_to.': '.$GET_CHARACTER_NAME.'</div>';
// -----------------------------------
// Do we have a character no ?
// -----------------------------------
if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	die();
}


	if(empty($_GET['select'])) {
		
		$query1 = $db_character->query("SELECT * FROM user_character WHERE character_no = '".$GET_CHARACTER_NO."' ");
		$getCharacter = $db_character->fetchArray($query1);

			echo "
			<form method='GET'>
			<fieldset>
			<legend>".LAN_step." 1</legend>
				<table >
					<tr class='even'>
						<td >".LAN_level." ".LAN_range."</td>
						<td ><select name='min_max' style='width:213px;'>
								<option value='1_30'>Lv 1 - Lv 30</option>
								<option value='30_50'>Lv 30 - Lv 50</option>
								<option value='50_80'>Lv 50 - Lv 80</option>
								<option value='80_100'>Lv 80 - Lv 100</option>
								<option value='100_130'>Lv 100 - Lv 130</option>
								<option value='130_150'>Lv 130 - Lv 150</option>
								<option value='150_175'>Lv 150 - Lv 175</option>
								<option value='175_200'>Lv 175 - Lv 200</option>
							</select>
							<br>
							
						</td>
					</tr>
					<tr class='even'>
						<td >".LAN_class."</td>
						<td ><select name='item_class' style='width:213px;'>";
								if($getCharacter['byPCClass'] == '0') {
									echo "<option value='0_0' selected>".LAN_class_ak."</option>";
								} else {
									echo "<option value='0_0'>".LAN_class_ak."</option>";
								}
								if($getCharacter['byPCClass'] == '1') {
									echo "<option value='0_1' selected>".LAN_class_sh."</option>";
								} else {
									echo "<option value='0_1'>".LAN_class_sh."</option>";
								}
								if($getCharacter['byPCClass'] == '2') {
									echo "<option value='0_2' selected>".LAN_class_im."</option>";
								} else {
									echo "<option value='0_2'>".LAN_class_im."</option>";
								}
								if($getCharacter['byPCClass'] == '3') {
									echo "<option value='0_3' selected>".LAN_class_vs."</option>";
								} else {
									echo "<option value='0_3'>".LAN_class_vs."</option>";
								}
								if($getCharacter['byPCClass'] == '4') {
									echo "<option value='1_0' selected>".LAN_class_se."</option>";
								} else {
									echo "<option value='1_0'>".LAN_class_se."</option>";
								}
								if($getCharacter['byPCClass'] == '5') {
									echo "<option value='1_1' selected>".LAN_class_bw."</option>";
								} else {
									echo "<option value='1_1'>".LAN_class_bw."</option>";
								}
								if($getCharacter['byPCClass'] == '6') {
									echo "<option value='1_1' selected>".LAN_class_al."</option>";
								} else {
									echo "<option value='1_1'>".LAN_class_al."</option>";
								}

						echo "</select>
						</td>
					</tr>
					<tr class='even'>
						<td>
							<input type='hidden' name='select' value='1'>
							<input type='hidden' name='character' value='".$GET_CHARACTER_NO."'>
							<input type='hidden' name='character_name' value='".$GET_CHARACTER_NAME."'>
							<input type='submit' value='".LAN_next."'>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</fieldset>
			</form>";
		
	} elseif($_GET['select'] == '1') {
	
	
		list($minlv,$maxlv) = explode("_",$_GET['min_max']);
		
		$result1 = $db_osds->query("SELECT * FROM itemweapon WHERE ReqLv >= '".$minlv."' AND ReqLv <= '".$maxlv."' AND Name NOT LIKE '%+%' ORDER BY Convert(int, ReqLv) ASC");
		


		echo "<form method='GET'>
		<fieldset>
		<legend>".LAN_step." 2</legend>
			<table >
				<tr class='even'>
					<td >".LAN_weapons."</td>
					<td ><select name='item_name' style='width:213px;'>";
					$count = explode("_",$_GET['item_class']);
						while($getItems = $db_osds->fetchArray($result1))
						{
							$job = explode("-",$getItems['Job']);
							$job_count = $job[$count[0]];
							if($job_count[$count[1]] == '1') {
								echo "<option value='".$getItems['Name']."'>".LAN_level." ".$getItems['ReqLv']." - ".$getItems['Name']."</option>";
							}
						}
						echo "</select>
					</td>
				</tr>
				<tr class='even'>
					<td >".LAN_hmit." ".LAN_weapon."</td>
					<td ><select name='how_plus' style='width:213px;'>
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
				<tr class='even'>
					<td><label>".LAN_subject."</label></td>
					<td><input name='post_title' size='50' type='text' value='".LAN_sw_def_subject."'></td>
				</tr>
				<tr class='even'>
					<td><label>".LAN_message."</label></td>
					<td><textarea name='body_text' cols='45' rows='5' style='height: 100px;'>".LAN_sw_def_message."</textarea></td>
				</tr>

				<tr class='even'>
					<td>
						<input type='hidden' name='select' value='2'>
						<input type='hidden' name='character' value='".$GET_CHARACTER_NO."'>
						<input type='hidden' name='character_name' value='".$GET_CHARACTER_NAME."'>
						<input type='hidden' name='class' value='".$_GET['item_class']."'>
						<input type='submit' value='".LAN_send."'>
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			</fieldset>
		</form>";
	}
	elseif($_GET['select'] == '2')
	{
		if($_GET['how_plus'] == '0')
		{
			$result1 = $db_osds->query("SELECT * FROM itemweapon WHERE Name = '".$_GET['item_name']."'");
		}
		else
		{
			$result1 = $db_osds->query("SELECT * FROM itemweapon WHERE Name = '".$_GET['item_name']." +".$_GET['how_plus']."'");
		}
		$row1 = $db_osds->FetchArray($result1);

		if(empty($row1['Name']) || $row1['Name'] == '0') 
		{
			echo LAN_sa_error1;
		}
		else
		{
			$query1 = $db_character->query("EXEC SP_POST_SEND_OP '".$_GET['character']."','".$_SESSION['USER']."',1,'".$_GET['post_title']."','".$_GET['body_text']."','".$row1['Id']."',0,0");
				echo '<div class="success msg">'.LAN_weapon.' '.LAN_send.'</div>';

		}

	}
	
echo '</fieldset>';
echo FOOTER;

?>
