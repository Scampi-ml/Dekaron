<center>
<?php
$file = 'account';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if($is_gm != '0') {
	if(empty($_POST['select'])) {
		echo "<center><br><form action='?function=account&uc=".$uc."' method='POST'>
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
					<td align='center' colspan='2'><b>".$language['split2']."</b></td>
				</tr>
				<tr>
					<td align='center'>".$language['split3']."</td>
					<td><input type='text' name='accname' maxlength='20'></td>
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

		if(empty($_POST['charname']) && empty($_POST['accname'])) {
			echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!empty($_POST['charname']) && !empty($_POST['accname'])) {
			echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} else {
			$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

			if(empty($_POST['charname'])) {
				$result1 = mssql_query("SELECT user_no FROM account.dbo.Tbl_user WHERE user_id = '".$_POST['accname']."'",$ms_con);
				$count1 = mssql_num_rows($result1);
				$row1 = mssql_fetch_row($result1);
			} else {
				$result1 = mssql_query("SELECT user_no FROM character.dbo.user_character WHERE character_name = '".$_POST['charname']."'",$ms_con);
				$count1 = mssql_num_rows($result1);
				$row1 = mssql_fetch_row($result1);
				$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_no = '".$row1[0]."'",$ms_con);
				$count2 = mssql_num_rows($result2);
			}


			if(empty($_POST['charname']) && $count1 < '1') {
				echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['charname']) && $count1 > '1') {
				echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['accname']) && $count1 < '1') {
				echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['accname']) && $count1 > '1') {
				echo "<br>".$language['error6']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['accname']) && $count2 < '1') {
				echo "<br>".$language['error7']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} elseif(empty($_POST['accname']) && $count2 > '1') {
				echo "<br>".$language['error8']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
			} else {

				$result3 = mssql_query("SELECT user_id,user_pwd,user_mail,user_answer,user_question FROM account.dbo.Tbl_user WHERE user_no = '".$row1[0]."'",$ms_con);
				$row3 = mssql_fetch_row($result3);

				echo "<center><form action='?function=account&uc=".$uc."' method='POST'>
					<table class='innertab'>
						<tr>
							<td colspan='3' align='center'><b><u>".$language['head1']."</b></u></td>
						</tr>
						<tr>
							<td colspan='3' align='center'>&nbsp;</td>
						</tr>
						<tr>
							<td align='center'>".$language['split4']."</td>
							<td align='center'>".$language['split5']."</td>
							<td align='center'>".$language['split6']."</td>
						</tr>
						<tr>
							<td align='center'>".$language['split3']."</td>
							<td align='center'>".$row3[0]."</td>
							<td align='center'><input type='text' name='user_acc' maxlength='20' value='".$row3[0]."'></td>
						</tr>
						<tr>
							<td align='center'>".$language['split7']."</td>
							<td align='center'>".$row3[1]."</td>
							<td align='center'><input type='text' name='user_pwd' maxlength='20' value='".$row3[1]."'></td>
						</tr>
						<tr>
							<td align='center'>".$language['split8']."</td>
							<td align='center'>".$row3[2]."</td>
							<td align='center'><input type='text' name='user_mail' maxlength='100' value='".$row3[2]."'></td>
						</tr>
						<tr>
							<td align='center'>".$language['split9']."</td>
							<td align='center'>".$row3[4]."</td>
							<td align='center'><input type='text' name='user_ques' maxlength='20' value='".$row3[4]."'></td>
						</tr>
						<tr>
							<td align='center'>".$language['split10']."</td>
							<td align='center'>".$row3[3]."</td>
							<td align='center'><input type='text' name='user_answ' maxlength='20' value='".$row3[3]."'></td>
						</tr>
						<tr>
							<td align='center' colspan='3'>
								<input type='hidden' name='select' value='2'>
								<input type='hidden' name='user_no' value='".$row1[0]."'>
								<input type='submit' value='".$language['button2']."'>
							</td>
						</tr>
					</table>
				</form></center>";

			}
		}
	} elseif($_POST['select'] == '2') {

		$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

		$result1 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['user_mail']."'",$ms_con);
		$count1 = mssql_num_rows($result1);

		if(empty($_POST['user_pwd']) || empty($_POST['user_mail']) || empty($_POST['user_ques']) || empty($_POST['user_answ'])) {
			echo "<br>".$language['error9']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['user_pwd'])) {
			echo "<br>".$language['error10']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['user_pwd']) < 6 || strlen($_POST['user_pwd']) > 12) {
			echo "<br>".$language['error11']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['user_mail'])) {
			echo "<br>".$language['error12']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['user_ques']) < 10 || strlen($_POST['user_ques']) > 20) {
			echo "<br>".$language['error13']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['user_answ']) < 10 || strlen($_POST['user_answ']) > 20) {
			echo "<br>".$language['error14']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
		} else {

			$crypt_user_pwd = md5($_POST['user_pwd']);

			mssql_query("UPDATE 
					account.dbo.Tbl_user 
				SET 
					user_pwd = '".$_POST['user_pwd']."',
					user_mail = '".$_POST['user_mail']."',
					user_answer = '".$_POST['user_answ']."',
					user_question = '".$_POST['user_ques']."'
				WHERE
					user_no = '".$_POST['user_no']."'",$ms_con);

			mssql_query("UPDATE 
					account.dbo.USER_PROFILE 
				SET 
					user_pwd = '".$crypt_user_pwd."'
				WHERE
					user_no = '".$_POST['user_no']."'",$ms_con);

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