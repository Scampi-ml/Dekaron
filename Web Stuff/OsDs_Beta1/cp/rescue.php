<center>
<?php
$file = 'rescue';
if($is_gm != '0') {
if(empty($_POST['select'])) {
	echo "<center><form action='?function=rescue&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='2' align='center'><b><u>Set character back to homepoint</b></u></td>
			</tr>
			<tr>
				<td colspan='2' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>Character name</td>
				<td><select name='char_no'>";
					$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
					$result = mssql_query("SELECT character_no,character_name FROM character.dbo.user_character WHERE user_no = '".$user_no."'",$ms_con);

					while($row = mssql_fetch_row($result)) {
						echo "<option value='".$row[0]."'>".$row[1]."</option>";
					}
				echo "</select></td>
			</tr>
			<tr>
				<td align='center' colspan='2'>
					<input type='hidden' name='select' value='1'>
					<input type='submit' value='Set me back'>
				</td>
			</tr>
		</table>
	</form></center>";
} elseif($_POST['select'] == '1') {
	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	mssql_query("UPDATE character.dbo.user_character SET wMapIndex = wRetMapIndex , wPosX = wRetPosX , wPosY = wRetPosY WHERE character_no = '".$_POST['char_no']."'",$ms_con);

	echo "<br>You are back at your homepoint";

} else {
	echo "<br>Error";
}
}
?>
</center>