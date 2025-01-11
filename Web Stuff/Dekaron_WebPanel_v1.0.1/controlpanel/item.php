<center>
<?php
$file = 'item';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=item&uc=".$uc."' method='POST'>
			<table class='innertab'>
				<tr>
					<td colspan='2' align='center'><b><u>".$language['head1']."</b></u></td>
				</tr>
				<tr>
					<td colspan='2' align='center'>&nbsp;</td>
				</tr>
				<tr>
					<td align='center'>".$language['split1']."</td>
					<td><input type='text' name='charname' maxlength='20'></td>
				</tr>
				<tr>
					<td align='center'>".$language['split2']."</td>
					<td><input type='text' name='itemid' maxlength='6'></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<input type='hidden' name='select' value='1'>
						<input type='submit' value='".$language['button1']."'>
					</td>
				</tr>
			</table>
		</form></center>";
	} elseif($_POST['select'] == '1') {
		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if($count1 < '1') {
			echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($count > '1') {
			echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9]?/",$_POST['itemid'])) {
			echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} else {
			$result2 = mssql_query("SELECT character_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
			$row2 = mssql_fetch_row($result2);

			mssql_query("EXEC character.dbo.SP_POST_SEND_OP '".$row2[0]."','".$gm_name."',1,'".$language['title']."','".$language['body']."','".$_POST['itemid']."',0,0",$ms_con);

			echo "<br>".$language['ready'];

		}

	} else {
		echo "<br>".$language['s_error1'];
	}
} else {
	echo "<br>".$language['s_error2'];
}

?>
</center>