
<center>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?do=deldoquest&id=".$id."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='center'><img src='images/content/content_del_d_q.png' valign='left'><br></td>
				</tr>
				<tr>
					<td colspan='2' align='center'><span class='style1'>WARNING: This will DELETE everything WHERE character_name is found!</span></td>
				</tr>
				<tr>
					<td align='center'>Character Name</td>
					<td><input type='text' name='charname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='hidden' name='select' value='1'>
						<input type='submit' value='Do it !'>
					</td>
				</tr>
			</table>
		</form></center>";
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>Could not find the character name.<br><a href='javascript:history.back()'>Back</a>";

		} else {
		
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$row2 = mssql_fetch_row($result2);
		
		
		mssql_query("DELETE FROM character.dbo.User_Quest_Done WHERE character_no = '".$row2[0]."'",$ms_con);
		echo "<br><center>The characters done quest's has been successfully deleted.</center>";

		}

	} else {
		echo "<br><img src='images/error_action.png'>";
	}
} else {
	echo "<br><img src='images/error_access.png'>";
}

?>

</center>