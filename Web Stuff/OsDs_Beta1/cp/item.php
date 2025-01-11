<center>
<?php
$file = 'item';
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=item&uc=".$uc."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='left'><b><u>Send Item to Character</b></u></td>
				</tr>
				<tr>
					<td colspan='2' align='left'>&nbsp;</td>
				</tr>
				<tr>
					<td align='left'>Character Name</td>
					<td><input type='text' name='charname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='left'>Item ID</td>
					<td><input type='text' name='itemid' maxlength='6'></td>
				</tr>
				<tr>
					<td align='left'>Dill</td>
					<td><input type='text' name='dill' maxlength='9'></td>
				</tr>
				<tr>
					<td align='left' colspan='2'>
						<input type='hidden' name='select' value='1'>
						<input type='submit' value='Send'>
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
		} elseif($count > '1') {
			echo "<br>There were several characters with this name is found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['itemid'])) {
			echo "<br>The item ID does only consist numbers.<br><a href='javascript:history.back()'>Back</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['dill'])) {
			echo "<br>The dill does only consist numbers.<br><a href='javascript:history.back()'>Back</a>";

		} else {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);

			mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".$row2[0]."','".$gm_name."',1,'Item for you','A [GM] send a item for you.','".$_POST['itemid']."','".$_POST['dill']."',0",$ms_con);

			echo "<br>The mail has been sent successfully.";

		}

	} else {
		echo "<br>This function does not exist.";
	}
} else {
	echo "<br>You are not a GM , you have no access to this function.";
}

?>
</center>