<?php
// -----------------------------------
// Include header
// -----------------------------------
include ("header.php");

// -----------------------------------
// Insert Java
// -----------------------------------
?>
<script language="JavaScript">
	function point_it(event){
		pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("pointer_div").offsetLeft;
		pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("pointer_div").offsetTop;
		document.getElementById("cross").style.left = (pos_x-1) ;
		document.getElementById("cross").style.top = (pos_y-15) ;
		document.getElementById("cross").style.visibility = "visible" ;
		document.pointform.form_x.value = pos_x;
		document.pointform.form_y.value = pos_y;
	}
</script>
<?php
// -----------------------------------
// Get the character
// ----------------------------------- 
$GET_CHARACTER_NO = $_GET['character'];

// -----------------------------------
// Do we have a character no ?
// -----------------------------------
if ($GET_CHARACTER_NO == "")
{
	echo '<div class="error msg">Error getting character. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM character.dbo.user_character WHERE character_no = "'.$GET_CHARACTER_NO.'" ');
$getCharacterPos = $db->fetchArray($query1);

$map = $getCharacterPos['wMapIndex'];
$x = $getCharacterPos['wPosX'];
$y = $getCharacterPos['wPosY'];
$img = $array_map_img[$map];

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Map Postition of ' . $getCharacterPos['character_name'] . '</h1>

	<div id="pointer_div" onclick="point_it(event)" style = "background-image:url(' . $img . ');width:512px;height:512px;">
		<div style="position: relative; top: '.$x.'px; left: '.$y.'px;">
			<img src="images/pointcurrent.png" border="0" /> 
		</div>
	</div>
<br> 
	
	(Current X: ' . $x . ')<br> 
	(Current Y: ' . $y . ')



</article>';
// -----------------------------------
// include footer
// -----------------------------------
include "footer.php";


?>