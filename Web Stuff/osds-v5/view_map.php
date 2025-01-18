<?php
include ("osdscore.php");

if (file_exists('array_map_img.php')) 
{
	include ( "array_map_img.php" ); 
}
else
{
	include ("array_map_img_int.php" );
}
 
$query = $db_character->query("SELECT wMapIndex,wPosY,wPosX,character_no,character_name FROM user_character WHERE character_no = '".$_GET['character']."' ");
$getCharacterPos = $db_character->fetchArray($query);

$map = $getCharacterPos['wMapIndex'];
$x = $getCharacterPos['wPosY'];
$y = $getCharacterPos['wPosX'];
$img = $array_map_img[$map];
?>

<div style="float:left;">
	<div style="width:512px;height:512px;">
		<img src="view_map_image.php?axisy=<?php echo $y; ?>&axisx=<?php echo $x; ?>&map=<?php echo $img; ?>" border="0" />
	</div>
</div>

<div style="float:right; ">
    <br>
    <div class="group">
        <b>Map Position</b>
        <br>
        <br>
        <table>
            <tr>
                <td><label>Name</label></td>
                <td><input type="text"  DISABLED  value="<?php echo $getCharacterPos['character_name']; ?>" /></td>
            </tr>
    
            <tr class="even">
                <td><label>Current X</label></td>
                <td><input type="text"  DISABLED  value="<?php echo $x; ?>" /></td>
            </tr>
            <tr class="even">
                <td><label>Current Y</label></td>
                <td><input type="text" DISABLED  value="<?php echo $y; ?>" /></td>
            </tr>
            <tr class="even">
                <td><label>Current Map Id</label></td>
                <td><input type="text"  DISABLED  value="<?php echo $map; ?>" /></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>