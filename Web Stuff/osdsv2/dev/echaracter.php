<?php
$char_name = $_GET['char_name'];
?>
	<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>You are editing: </strong>&quot;<?php echo $char_name; ?>&quot;
			</p>
							
			<p>
				<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><a href="#" id="dialog_link5" class="ui-state-default ui-corner-all"></span> More info </a></p>
            	<div id="dialog5" title="More info about character editing">
            <p>
            	You can edit your character any way you want, but there are some limitations. Like:<br />
				     <ul>
						<li>DISABLED: user_no (Very bad idea to change this!)</li>
						<li>DISABLED: character_no (You dont need to change that)</li>
						<li>DISABLED: dwPeerage (You dont need to change that)</li>
						<li>DISABLED: nHP (You dont need to change that)</li>
						<li>DISABLED: nMP (You dont need to change that)</li>
						<li>DISABLED: wPosX (You dont need to change that)</li>
						<li>DISABLED: wPosY (You dont need to change that)</li>
						<li>DISABLED: wRetPosX (You dont need to change that)</li>
						<li>DISABLED: wRetPosX (You dont need to change that)</li>
						<li>DISABLED: wMapIndex (See other osdsv2 functions)</li>
						<li>DISABLED: wRetMapIndex (See other osdsv2 functions)</li>
						<li>DISABLED: byPCClass (Very bad idea to change this!)</li>
						<li>DISABLED: byDirection (You dont need to change that)</li>
						<li>DISABLED: byRetDirection (You dont need to change that)</li>
						<li>DISABLED: wPKCount (You dont need to change that)</li>
						<li>DISABLED: nShield (You dont need to change that)</li>
						<li>DISABLED: dwFlag  (You dont need to change that, and i dont even know what it does)</li>
						<li>DISABLED: login_flag (You dont need to change that)</li>
						<li>DISABLED: dwPVPPoint (You dont need to change that)</li>
						<li>DISABLED: wWinRecord (You dont need to change that)</li>
						<li>DISABLED: wLoseRecord (You dont need to change that)</li>
						<li>DISABLED: wDrawRecord (You dont need to change that)</li>
						<li>DISABLED: dwSupplyPoint (You dont need to change that, i think thats for siege)</li>
						<li>DISABLED: Reborn some server may not or dont want it</li>
            		</ul>

            	I have disabled this for security reasons, or you dont need to edit them<br />
				If you do wanna change them, you can edit this script, but be carefull what you edit!<br>
				Please make sure the character you are tying to edit is logged out.
            </p>
            </div>

			
	</div></div><br>
<?php
  $query = "SELECT * FROM character.dbo.user_character WHERE character_name = '$char_name'";
  $result = mssql_query($query);
  $row = mssql_fetch_array($result);

  
  $user_no = $row["user_no"];
  
  
  $query1 = "SELECT * FROM account.dbo.USER_PROFILE WHERE user_no = '$user_no'"; 
  $result1 = mssql_query($query1);
  $row1 = mssql_fetch_array($result1);
  
  $login = $row1["login_flag"];


if($login == '1100'){ 
?>
<div class='ui-widget'>
	<div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
		<p>
        	<center><span class="blink"><h2><?php echo $char_name; ?> is reported as online, please logout the character!</h2></span></center>
        </p>
	</div>
</div>
<br />
<?php
} else {
echo "";
}
include "classarray.php";
include "resetarray.php";
include "loginarray.php";

echo '<div class="ui-widget-content ui-corner-all" >';


if(empty($_POST['select'])) {
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
						<td align='left'>".$row["user_no"]."</td>
					</tr>

					<tr>
						<td align='left'>Character Name</td>
						<td align='left'>".$row["character_name"]."</td>
						<td align='left'><input type='text' name='new_exp' maxlength='20' value='".$row["character_name"]."'></td>
					</tr>
					<tr>
						<td align='left'>Experience</td>
						<td align='left'>".$row["dwExp"]."</td>
						<td align='left'><input type='text' name='new_exp' maxlength='20' value='".$row["dwExp"]."'></td>
					</tr>
						<tr>
						<td align='left'>Adv</td>
						<td align='left'>".$row["dwAdv"]."</td>
						<td align='left'><input type='text' name='new_adv' maxlength='20' value='".$row["dwAdv"]."'></td>
					</tr>
						<tr>
						<td align='left'>Hp</td>
						<td align='left'>".$row["nHP"]."</td>
						<td align='left'><input type='text' name='new_hp' maxlength='20' value='".$row["nHP"]."'></td>
					</tr>
						<tr>
						<td align='left'>Mp</td>
						<td align='left'>".$row["nMP"]."</td>
						<td align='left'><input type='text' name='new_mp' maxlength='20' value='".$row["nMP"]."'></td>
					</tr>
					<tr>
						<td align='left'>Level</td>
						<td align='left'>".$row["wLevel"]."</td>
						<td align='left'><input type='text' name='new_lvl' maxlength='20' value='".$row["wLevel"]."'></td>
					</tr>
					<tr>
						<td align='left'>Class</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$classarray[$row["byPCClass"]]."</td>
					</tr>
					<tr>
						<td align='left'>Str points</td>
						<td align='left'>".$row["wStr"]."</td>
						<td align='left'><input type='text' name='new_str' maxlength='20' value='".$row["wStr"]."'></td>
					</tr>
					<tr>
						<td align='left'>Dex points</td>
						<td align='left'>".$row["wDex"]."</td>
						<td align='left'><input type='text' name='new_dex' maxlength='20' value='".$row["wDex"]."'></td>
					</tr>
					<tr>
						<td align='left'>Con points</td>
						<td align='left'>".$row["wCon"]."</td>
						<td align='left'><input type='text' name='new_con' maxlength='20' value='".$row["wCon"]."'></td>
					</tr>
					<tr>
						<td align='left'>Spr points</td>
						<td align='left'>".$row["wSpr"]."</td>
						<td align='left'><input type='text' name='new_spr' maxlength='20' value='".$row["wSpr"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Inventory</td>
						<td align='left'>".$row["dwMoney"]."</td>
						<td align='left'><input type='text' name='new_inv_money' maxlength='20' value='".$row["dwMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Warehouse</td>
						<td align='left'>".$row["dwStorageMoney"]."</td>
						<td align='left'><input type='text' name='new_war_money' maxlength='20' value='".$row["dwStorageMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>DIL Shop</td>
						<td align='left'>".$row["dwStoreMoney"]."</td>
						<td align='left'><input type='text' name='new_inv_money' maxlength='20' value='".$row["dwStoreMoney"]."'></td>
					</tr>
					<tr>
						<td align='left'>Current Map</td>
						<td align='left'>&nbsp;</td>
						<td align='left'>".$row["wMapIndex"]."</td>
					</tr>
					<tr>
						<td align='left'>Stats points</td>
						<td align='left'>".$row["wStatPoint"]."</td>
						<td align='left'><input type='text' name='new_stats' maxlength='20' value='".$row["wStatPoint"]."'></td>
					</tr>
					<tr>
						<td align='left'>Skill points</td>
						<td align='left'>".$row["wSkillPoint"]."</td>
						<td align='left'><input type='text' name='new_skill' maxlength='20' value='".$row["wSkillPoint"]."'></td>
					</tr>
					<tr>
						<td align='left'>Skill Reset</td>
						<td align='left'>".$skillresetarray [$row["byStatClearCount"]]."</td>
						<td align='left'><select name='new_skillreset' class='input'>";
								if($row["byStatClearCount"] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row["byStatClearCount"] == '0') {
									echo "<option value='0' selected>Unused</option>";
								} else {
									echo "<option value='0'>Unused</option>";
								}

					echo "</select></td>
					</tr>

						<tr>
						<td align='left'>Stats Reset</td>
						<td align='left'>".$statresetarray [$row["bySkillClearCount"]]."</td>
						<td align='left'><select name='new_statreset' class='input'>";
								if($row["bySkillClearCount"] == '1') {
									echo "<option value='1' selected>Used</option>";
								} else {
									echo "<option value='1'>Used</option>";
								}
								if($row["bySkillClearCount"] == '0') {
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
							<input type='hidden' name='char_no' value='".$row[0]."'>
							<input type='hidden' name='user_no' value='".$row[1]."'>
							<input type='hidden' name='char_name' value='".$_POST['charname']."'>
							<input type='submit' value='Save character stats'>
						</td>
					</tr>
				</table>
			</form></center></div>";
	} elseif($_POST['select'] == '2') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		
		$result1 = mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".$_POST['user_no']."'",$ms_con);
		$row1 = mssql_fetch_row($result1);
		if($row1[0] == '1100') {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE user_no = '".$_POST['user_no']."' ORDER by login_time DESC",$ms_con);
			$row = mssql_fetch_row($result2);
		}

		if($row1[0] == '1100' && $row[0] == $_POST['char_no']) {
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
