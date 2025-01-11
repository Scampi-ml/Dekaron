<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><b>Current character location</b></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Location of  "{$character_name}" </b>
<br>
<br>
<img src="script/current_location.php?x={$wPosX}&y={$wPosY}&color={$color}&pointer={$pointer}&map={$img}" border="0" width="512" height="512" /> 
<br>
<br>
<p class="msg_error">Current X: <i>{$wPosX}</i></p>
<p class="msg_error">Current Y: <i>{$wPosY}</i></p>
<p class="msg_error">Current Map Id: <i>{$wMapIndex}</i></p>
<p class="msg_error">Current Map Name: <i>{$wMapIndex2}</i></p>
<br>
<br>          
<input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_view_character_location&character={$character_no}')">
</td> 
</tr>
</table>	