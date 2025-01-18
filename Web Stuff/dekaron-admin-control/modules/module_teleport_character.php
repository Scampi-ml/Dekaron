<?php
if (isset($_POST) && !empty($_POST))
{
	include("engine/array_teleport.php");
	$map_id = $array_teleport[$_POST['tele_map']][0];
	$map_x = $array_teleport[$_POST['tele_map']][2];
	$map_y = $array_teleport[$_POST['tele_map']][3];

	$db->SQLquery("UPDATE character.dbo.user_character SET wMapIndex = '%s', wPosX = '%s', wPosY = '%s' WHERE character_no = '%s' ", $map_id, $map_x, $map_y, $_POST['character']);
	echo notice_message_admin('Character successfully teleported', '1', '0', 'index.php?get=module_teleport_character');
}
else
{
	include("engine/array_teleport.php");
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><div align="left"><b>Choose a location</b></div></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Pleas select the location you want to teleport the character to</b>
            <br><br>
            <select name="tele_map" style="width: 150px;">
				<?php
					$mapcount = count($array_teleport);
					$i = '0';
					for($i >= '0';$i < $mapcount;)
					{
						echo "<option value='".$i."'>".$array_teleport[$i][1]."</option>";
						$i++;
					}
                ?>
            </select>
            
            <br><br>
            <input type="hidden" name="character" value="<?php echo $_GET['character']; ?>" >
        	<input type="submit" value="teleport Character" onclick="ask_url('Are you sure you want to teleport this character ?','index.php?get=module_teleport_character')">
    	</td>
    </tr>
</table>	
</form>	
<?php
}
?>