<center>
<?php
$file = 'user';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}
if(empty($_POST['select'])) {

	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

	$result = mssql_query("SELECT user_id,user_pwd,user_mail,user_answer,user_question FROM account.dbo.Tbl_user WHERE user_no = '".$user_no."'",$ms_con);
	$row = mssql_fetch_row($result);

	echo "<center><form action='?function=user&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='3' align='center'><b><u>".$language['head1']."</b></u></td>
			</tr>
			<tr>
				<td colspan='3' align='center'>&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>".$language['split1']."</td>
				<td align='center'>".$language['split2']."</td>
				<td align='center'>".$language['split3']."</td>
			</tr>
			<tr>
				<td align='center'>".$language['split4']."</td>
				<td align='center'>".$row[0]."</td>
				<td align='center'><input type='text' name='user_acc' maxlength='20' value='".$row[0]."'></td>
			</tr>
			<tr>
				<td align='center'>".$language['split5']."</td>
				<td align='center'>".$row[1]."</td>
				<td align='center'><input type='text' name='user_pwd' maxlength='20' value='".$row[1]."'></td>
			</tr>
			<tr>
				<td align='center'>".$language['split6']."</td>
				<td align='center'>".$row[2]."</td>
				<td align='center'><input type='text' name='user_mail' maxlength='100' value='".$row[2]."'></td>
			</tr>
			<tr>
				<td align='center'>".$language['split7']."</td>
				<td align='center'>".$row[4]."</td>
				<td align='center'><input type='text' name='user_ques' maxlength='20' value='".$row[4]."'></td>
			</tr>
			<tr>
				<td align='center'>".$language['split8']."</td>
				<td align='center'>".$row[3]."</td>
				<td align='center'><input type='text' name='user_answ' maxlength='20' value='".$row[3]."'></td>
			</tr>
			<tr>
				<td align='center' colspan='3'>
					<input type='hidden' name='select' value='1'>
					<input type='submit' value='".$language['button1']."'>
				</td>
			</tr>
		</table>
	</form></center>";

} elseif($_POST['select'] == '1') {

	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

	$result1 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['user_mail']."'",$ms_con);
	$count1 = mssql_num_rows($result1);

	if(empty($_POST['user_pwd']) || empty($_POST['user_mail']) || empty($_POST['user_ques']) || empty($_POST['user_answ'])) {
		echo "<br>".$language['error1']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['user_pwd'])) {
		echo "<br>".$language['error2']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(strlen($_POST['user_pwd']) < 6 || strlen($_POST['user_pwd']) > 12) {
		echo "<br>".$language['error3']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['user_mail'])) {
		echo "<br>".$language['error4']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif($count1 > '0') {
		echo "<br>".$language['error5']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(strlen($_POST['user_ques']) < 10 || strlen($_POST['user_ques']) > 20) {
		echo "<br>".$language['error6']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
	} elseif(strlen($_POST['user_answ']) < 10 || strlen($_POST['user_answ']) > 20) {
		echo "<br>".$language['error7']."<br><a href='javascript:history.back()'>".$language['back']."</a>";
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
				user_no = '".$user_no."'",$ms_con);

		mssql_query("UPDATE 
				account.dbo.USER_PROFILE 
			SET 
				user_pwd = '".$crypt_user_pwd."'
			WHERE
				user_no = '".$user_no."'",$ms_con);

		echo "<br>".$language['ready1'];

	}
} else {
	echo "<br>".$language['s_error1'];
}

?>
</center>