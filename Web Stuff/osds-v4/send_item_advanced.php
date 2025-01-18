<?php
include "header.php"; 

// -----------------------------------
// Check for item db
// -----------------------------------
if (!check_db('osdsv4'))
{
	echo '<div class="error msg">This script requires a database with items!<br> Please install the additional database with the items.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Reset the sessions
// -----------------------------------
if (isset($_GET['reset']))
{
	$_SESSION['type'] = "None";
	$_SESSION['min_max'] = "None";
	$_SESSION['item_class'] = "None";
	$_SESSION['charname'] = "None";
	$_SESSION['item_name'] = "None";
	$_SESSION['itemid'] = "None";
	$_SESSION['body_text'] = "None";
	$_SESSION['post_title'] = "None";
	$_SESSION['completed'] = "None";
	header('Location: send_item_advanced.php');
}

// -----------------------------------
// Set the default step
// -----------------------------------
if (!isset($_GET['step']))
{
	if(!isset($_GET['senditem']))
	{
		header('Location: send_item_advanced.php?step=default');
	}
}

// -----------------------------------
// Post the values
// -----------------------------------
if (isset($_POST['submit']))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		if ($key == 'submit') {
			continue;
		}

		$_SESSION[$key] = $val;
	}
}

// -----------------------------------
// Send the item
// -----------------------------------
if (isset($_GET['senditem']))
{
	$query = $db->query('SELECT * FROM character.dbo.user_character WHERE character_name = "' . $_SESSION['charname'] . '" ');
	$getCharacter = $db->fetchArray($query);
	
	$db->query("EXEC character.dbo.SP_POST_SEND_OP '".$getCharacter['character_no']."','".$_SESSION['user_id']."',1,'".$_SESSION['post_title']."','".$_SESSION['body_text']."','".$_SESSION['itemid']."',0,0");
	echo '<div class="success msg">Item has been send!</div>';
}

// -----------------------------------
// Class Job Name
// -----------------------------------
$array_class_job_name = array(
'0_0' => "Azure Knight", 
'0_1' => "Segita Hunter", 
'0_2' => "Incar Magician", 
'0_3' => "Vicious Summoner", 
'1_0' => "Segnale", 
'1_1' => "Bagi Warrior"
); 

// -----------------------------------
// Set sessions to noting
// -----------------------------------
if (!isset($_SESSION['item_class'])){$_SESSION['item_class'] = "None";}
if (!isset($_SESSION['type'])){$_SESSION['type'] = "None";}
if (!isset($_SESSION['min_max'])){$_SESSION['min_max'] = "None";}
if (!isset($_SESSION['charname'])){$_SESSION['charname'] = "None";}
if (!isset($_SESSION['item_name'])){$_SESSION['item_name'] = "None";}
if (!isset($_SESSION['itemid'])){$_SESSION['itemid'] = "None";}
if (!isset($_SESSION['post_title'])){$_SESSION['post_title'] = "None";}
if (!isset($_SESSION['body_text'])){$_SESSION['body_text'] = "None";}
if (!isset($_SESSION['completed'])){$_SESSION['completed'] = "None";}

// -----------------------------------
// The steps
// -----------------------------------
switch($_GET['step'])
{
	##################################################################################################
	default:
		if ($_SESSION['completed'] != '100')
		{
			$_SESSION['completed'] = '0';
		}
		$query = $db->query('SELECT * FROM character.dbo.user_character WHERE character_no NOT LIKE "%DEKARON%" ');
		$next_step = '?step=1';
		$button = 'Next & Select Item Level';
		$button_value = 'submit';
		$html = '<dt><label>Character Name</label></dt>
				 <dd><select name="charname" class="medium">';
				 
				 while ($getCharacters = $db->fetchArray($query))
				{
					 $html .= "<option value=". $getCharacters['character_name'] .">" . $getCharacters['character_name'] . "</option>";
				}
		  $html .= '</select>
				<small>The characters class will be selected for you.</small></dd>
				';
	break;
	##################################################################################################
	case "1":
		$_SESSION['completed'] = '20';
		$query2 = $db->query('SELECT * FROM character.dbo.user_character WHERE character_name = "' . $_SESSION['charname'] . '"  ');
		$getCharacters2 = $db->fetchArray($query2);
		$array_class_job = array(
								'0' => "0_0", 
								'1' => "0_1", 
								'2' => "0_2", 
								'3' => "0_3", 
								'4' => "1_0", 
								'5' => "1_1"
								);

		
		$_SESSION['item_class'] = $array_class_job[$getCharacters2['byPCClass']];
		
		$next_step = '?step=2';
		$button = 'Next & Select Item Type';
		$button_value = 'submit';
		$html = '<dt><label>Select Item Level</label></dt>
				 <dd><select name="min_max" class="medium">
						<option value="1_30">Level 1 - Level 30</option>
						<option value="30_50">Level 30 - Level 50</option>
						<option value="50_80">Level 50 - Level 80</option>
						<option value="80_100">Level 80 - Level 100</option>
						<option value="100_200">Level 100 - Level 200</option>
					</select>
					</dd>';
	break;
	##################################################################################################
	case "2":
		$_SESSION['completed'] = '40';
		$next_step = '?step=3';
		$button = 'Next & Show Available Items';
		$button_value = 'submit';
		$html = '<dt><label>Select Item Type</label></dt>
				 <dd><select name="type" class="medium">
				 		<option value="Weapon">Weapons</option>
						<option value="Armor">Armor</option>
					 </select>
				</dd>

				 
				 
		';
	break;
	##################################################################################################
	case "3":
		$_SESSION['completed'] = '60';
		$next_step = '?step=4';
		$button = 'Next & Select Plus';
		$button_value = 'submit';

		list($minlv,$maxlv) = explode("_", $_SESSION['min_max']);
		 if ($_SESSION['type'] == "Weapon")
		 {
		
			$query3 = $db->query('SELECT * FROM osdsv4.dbo.itemweapon WHERE ReqLv >= '.$minlv.' AND ReqLv <= '.$maxlv.' AND Name NOT LIKE "%+%" ORDER BY Convert(int, ReqLv) ASC ');
			
			$html = '<dt><label>Select Item</label></dt>
						<dd><select name="item_name" class="medium">';
						
						$count = explode("_", $_SESSION['item_class']);
						while($getItems = $db->fetchArray($query3))
						{
							$job = explode("-",$getItems['Job']);
							$job_count = $job[$count[0]];
							if($job_count[$count[1]] == '1') {
								$html .= "<option value='".$getItems['Name']."'>Level ".$getItems['ReqLv']." - ".$getItems['Name']."</option>";
							}
						}
			$html .= '</select></dd>';
		} elseif ($_SESSION['type'] == "Armor"){
		
			$query3 = $db->query('SELECT * FROM osdsv4.dbo.itemarmor WHERE ReqLv >= '.$minlv.' AND ReqLv <= '.$maxlv.' AND Name NOT LIKE "%+%" ORDER BY Convert(int, ReqLv) ASC ');
			
			$html = '<dt><label>Select Item</label></dt>
						<dd><select name="item_name" class="medium">';
						
						$count = explode("_", $_SESSION['item_class']);
						while($getItems = $db->fetchArray($query3))
						{
							$job = explode("-",$getItems['Job']);
							$job_count = $job[$count[0]];
							if($job_count[$count[1]] == '1') {
								$html .= "<option value='".$getItems['Name']."'>Level ".$getItems['ReqLv']." - ".$getItems['Name']."</option>";
							}
						}
			$html .= '</select></dd>';

		
		} else {
			echo "Euhm that option does not exist";
			die();
		}
		
	break;
	##################################################################################################
	case "4":
	
		$completed = "80%";
		$_SESSION['completed'] = '80';

		$next_step = '?step=5';
		$button = 'Next & Validate wizard';
		$button_value = 'submit';

		if ($_SESSION['type'] == "Weapon")
		{
			$query4 = $db->query('SELECT * FROM osdsv4.dbo.itemweapon WHERE Name LIKE "%'.$_SESSION['item_name'].'%" ');
			$getItemsNum = $db->fetchNum($query4);
			$html = '<dt><label>Select Plus</label></dt>
					<dd><select name="item_name" class="medium">';
					
					while($getItems = $db->fetchArray($query4))
					{
						$html .= "<option value='".$getItems['Name']."'>".$getItems['Name']."</option>";
					}
		$html .= '</select></dd>';

			
		} elseif ($_SESSION['type'] == "Armor"){
			$html = '<div class="error msg">Sorry, but i can send armors with a + on it!<br> Press "Next" to continue.</div>';
		} else {
			echo "Cant plus something that does not exist";
			die();
		}
	break;

	break;
	##################################################################################################
	case "5":
		$query5 = $db->query('SELECT * FROM osdsv4.dbo.itemweapon WHERE Name LIKE "%'.$_SESSION['item_name'].'%" ');
		$getItem = $db->fetchArray($query5);
		
		$_SESSION['itemid'] = $getItem['Item'];
		$_SESSION['completed'] = '100';

		$next_step = 'send_item_advanced.php?senditem=senditem';
		$button = 'Send Item';
		$button_value = 'submit';
		$html = '<div class="warning msg">Please check the list above.
				<br>
				If you happy with the results, press "Send Item".
				<br>
				If you wish to start over, press the "Reset" button.
				</div>
				<dt><label>Your Name</label></dt>
				<dd><input name="from_char_nm" type="text" class="required medium" id="from_char_nm" value="' . $_SESSION['user_id'] . '"></dd>
				
				<dt><label>Subject</label></dt>
				<dd><input name="post_title" type="text" class="required medium" id="post_title" value="Item for you"></dd>
				
				<dt><label>Message</label></dt>
				<dd><textarea name="body_text" class="medium">A GM send a item for you.</textarea></dd>
			';

	break;
	##################################################################################################

}


// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Send Item (Wizard) </h1>
	<div class="statistics">
		<table width="100%">
			<tr>
				<td width="50%"><b>Character</b></td>
				<td width="50%">' .  $_SESSION['charname'] . '</td>
			</tr>
			<tr>
				<td><b>Class</b></td>
				<td>';
				if ($_SESSION['item_class'] != 'None')
				{
					echo $array_class_job_name[$_SESSION['item_class']];
				} else {
					echo $_SESSION['item_class'];
				}
				 echo '</td>
			</tr>
			<tr>
				<td><b>Level</b></td>
				<td>' .  $_SESSION['min_max'] . '</td>
			</tr>
			<tr>
				<td><b>Type</b></td>
				<td>' .  $_SESSION['type'] . '</td>
			</tr>
			<tr>
				<td><b>Item</b></td>
				<td>' .  $_SESSION['item_name'] . '
				';
				
				if (is_numeric($_SESSION['itemid']))
				{
					echo "( ItemID : " . $_SESSION['itemid'] . " )";
				}
				echo '
				</td>
				</tr>';
								
				if(isset( $_SESSION['post_title'] ) )
				{	
					echo '<tr>';
					echo '<td><b>Subject</b></td>';
					echo '<td>' .  $_SESSION['post_title'] . '</td>';
					echo '</tr>';
				}

				if(isset( $_SESSION['body_text'] ) )
				{	
					echo '<tr>';
					echo '<td><b>Message</b></td>';
					echo '<td>' .  $_SESSION['body_text'] . '</td>';
					echo '</tr>';
				}



			echo '
			</tr>
		</table>
	</div>
	<div style="float:left">
		<button type="submit" class="button small red" onclick="location.href=&#39;send_item_advanced.php?reset=reset&#39;">Reset Wizard</button>
	</div>
	<div class="clear"></div>
	<hr>
	<form method="post" action="' . $next_step .'" class="uniform">
		<div align="right">' . $_SESSION['completed'] . '% Completed</div>
		<dl class="inline">
			<fieldset>';
	
		echo $html;
	
	echo '
			</fieldset>
		</dl>
		<button type="submit" name="'.$button_value.'" class="button small">' . $button .'</button>
	</form>
</article>';
		
include "footer.php";
?>