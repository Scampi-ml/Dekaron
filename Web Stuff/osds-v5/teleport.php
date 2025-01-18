<?php
include 'osdscore.php';


//+----------------------------------------------------------------------------+
//|     Include needed files
//| check for new files that need to be overwritten by the default php files inside the app
//+----------------------------------------------------------------------------+

if (file_exists('array_map.php')) 
{
include ( "array_map.php" ); 
}
else
{
	include ("array_map_int.php" );
}

if (file_exists('array_map_predefined.php')) 
{
include ( "array_map_predefined.php" ); 
}
else
{
	include ("array_map_predefined_int.php" );
}


echo HEADER;

// -----------------------------------
// Get the chararacter
// ----------------------------------- 
$GET_CHARACTER_NO = $_GET['character'];
$GET_CHARACTER_NAME = $_GET['character_name'];

$query = $db_character->query("SELECT * FROM user_character WHERE character_no = '" . $GET_CHARACTER_NO . "' ");
$result = $db_character->fetchArray($query);

if (isset($_GET['teleport']))
{
/*

	wPosX = '".$val."'
	wPosY = '".$val."'
	wMapIndex = '".$val."'
	".$key." = '".$val."'

	$update = $db_character->query("UPDATE user_character SET ".$key." = '".$val."' WHERE character_no = '" . $GET_CHARACTER_NO . "' ");
*/
}

// -----------------------------------
// Do we have a charater no ?
// -----------------------------------
if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	die();
}
// TODO: Able to change array_map_predefined.php
// TODO: Check char login


echo' 
<form class="uniform" method="get" action="teleport.php?character='.$GET_CHARACTER_NO.'">
	<input type="hidden" value="'.$GET_CHARACTER_NO.'" name="character">
	<div id="serverinfo">'.LAN_teleport.': ' . $GET_CHARACTER_NAME . '<span style="float:right;margin-top:-5px;"><input type="submit" value="'.LAN_teleport.' '.$GET_CHARACTER_NAME.'" name="teleport"></span></div>
	<div class="group">
		<table>
			<tr class="even">
				<td style="width:200px"><label>'.LAN_current.' '.LAN_location.'</label></td>
				<td>
					<input type="text" size="30" DISABLED value="'.$result['wPosX'].'" /> X
					<br>
					<input type="text" size="30" DISABLED value="'.$result['wPosY'].'" /> Y
					<br>
					<input type="text" size="30" DISABLED value="'.$array_map[$result['wMapIndex']].'" /> '.LAN_map.' '.LAN_name.'
					<br>
					<input type="text" size="30" DISABLED value="'.$result['wMapIndex'].'" /> '.LAN_map.' '.LAN_id.'
				</td>
			</tr>
			<tr class="even">
				<td><label>'.LAN_new.' '.LAN_location.'</label></dt>
				<td>';
					
					$mapcount = count($maps);
					$i = '0';
					
					echo "<select name='tele_map' style='width:400px;'>";
					
					$i = '0';
					for($i >= '0';$i < $mapcount;)
					{
						echo "<option value='".$i."' selected>[ ".$maps[$i][2]." ]&nbsp;&nbsp; [ ".$maps[$i][3]." ]&nbsp;&nbsp; [ ".$maps[$i][1]." ]</option>";
						$i++;
					}
					echo "</select>";
				
				
				echo '
				<br><small>'.LAN_legenda.': [X] - [Y] - ['.LAN_map.'] </small>
				</td>
			</tr>
		</table>
	</div>
</form>';
echo FOOTER;
?>
