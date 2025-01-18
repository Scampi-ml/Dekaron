<?php
flush_this();
$SQLquery1 = $db->SQLquery("SELECT character_no,character_name,wPosX,wPosY,wMapIndex FROM character.dbo.user_character WHERE character_no = '%s'", $_GET['character']);
$getCharacterInfo = $db->SQLfetchArray($SQLquery1);

require_once ('engine/array_map.php');
require_once ('engine/array_map_img.php');

$img = $array_map_img[$getCharacterInfo['wMapIndex']];

$pointer = $config->get('pointer', 'settings_view_character_location');
$color = $config->get('color', 'settings_view_character_location');
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><b>Current character location</b></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Location of  "<?php echo htmlspecialchars($getCharacterInfo['character_name']); ?>" </b>
            <br>
            <br>
            
            <img src="script/current_location.php?x=<?php echo htmlspecialchars($getCharacterInfo['wPosX']); ?>&y=<?php echo htmlspecialchars($getCharacterInfo['wPosY']); ?>&color=<?php echo $color; ?>&pointer=<?php echo $pointer; ?>&map=<?php echo $img; ?>" border="0" width="512" height="512" /> 
            <br>
            <br>
            <p class="msg_error">Current X: <i><?php echo htmlspecialchars($getCharacterInfo['wPosX']); ?></i></p>
            <p class="msg_error">Current Y: <i><?php echo htmlspecialchars($getCharacterInfo['wPosY']); ?></i></p>
            <p class="msg_error">Current Map Id: <i><?php echo htmlspecialchars($getCharacterInfo['wMapIndex']); ?></i></p>
            <p class="msg_error">Current Map Name: <i><?php echo htmlspecialchars($array_map[$getCharacterInfo['wMapIndex']]); ?></i></p>
            <br>
            <br>          
        	<input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_view_character_location&character=<?php echo htmlspecialchars($getCharacterInfo['character_no']); ?>')">
    	</td> 
    </tr>
</table>	
