<center>
<?php
$file = 'user';
include("../config/mssql.conf.php");
if($is_gm != '0') {
if(empty($_POST['select'])) {

	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

	$result = mssql_query("SELECT user_id,user_pwd,user_mail,referred FROM account.dbo.Tbl_user WHERE user_no = '".$user_no."'",$ms_con);
	$row = mssql_fetch_row($result);

	echo "<center><form action='?function=user&uc=".$uc."' method='POST'>
		<table class='innertab'>
			<tr>
				<td colspan='3' align='left'><b><u>Change my account</b></u></td>
			</tr>
			<tr>
				<td colspan='3' align='left'>&nbsp;</td>
			</tr>
			<tr>
				<td align='left'>Type</td>
				<td align='left'>Current Stats</td>
				<td align='left'>New Stats</td>
			</tr>
			<tr>
				<td align='left'>Account Name</td>
				<td align='left'>".$row[0]."</td>
				<td align='left'><input type='text' name='user_acc' maxlength='20' readonly='readonly' value='".$row[0]."'></td>
			</tr>
			<tr>
				<td align='left'>Password</td>
				<td align='left'>".$row[1]."</td>
				<td align='left'><input type='text' name='user_pwd' maxlength='20' value='".$row[1]."'></td>
			</tr>
			<tr>
				<td align='left'>E-Mail</td>
				<td align='left'>".$row[2]."</td>
				<td align='left'><input type='text' name='user_mail' maxlength='100' value='".$row[2]."'></td>
			</tr>
			<tr>
				<td align='left'>Referred</td>
				<td align='left'>".$row[4]."</td>
				<td align='left'><input type='text' name='referred' maxlength='20' readonly='readonly' value='".$row[4]."'></td>
			</tr>
			<tr>
				<td align='left' colspan='3'>
					<input type='hidden' name='select' value='1'>
					<input type='submit' value='Update my info'>
				</td>
			</tr>
		</table>
	</form></center>";

} elseif($_POST['select'] == '1') {

	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

	$result1 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['user_mail']."'",$ms_con);
	$count1 = mssql_num_rows($result1);

	if(empty($_POST['user_pwd']) || empty($_POST['user_mail']) || empty($_POST['user_ques']) || empty($_POST['user_answ'])) {
		echo "<br>You have not filled in all fields.<br><a href='javascript:history.back()'>Back</a>";
	} elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['user_pwd'])) {
		echo "<br>The password contains characters which are not allowed in the password.<br><a href='javascript:history.back()'>Back</a>";
	} elseif(strlen($_POST['user_pwd']) < 3 || strlen($_POST['user_pwd']) > 15) {
		echo "<br>The password must be at least 3 characters long and may exceed 15 characters.<br><a href='javascript:history.back()'>Back</a>";
	} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['user_mail'])) {
		echo "<br>This is not a valid email address.<br><a href='javascript:history.back()'>Back</a>";
	} else {

		$crypt_user_pwd = md5($_POST['user_pwd']);

		mssql_query("UPDATE 
				account.dbo.Tbl_user 
			SET 
				user_pwd = '".$_POST['user_pwd']."',
				user_mail = '".$_POST['user_mail']."',
			WHERE
				user_no = '".$user_no."'",$ms_con);

		mssql_query("UPDATE 
				account.dbo.USER_PROFILE 
			SET 
				user_pwd = '".$crypt_user_pwd."'
			WHERE
				user_no = '".$user_no."'",$ms_con);

		echo "<br>Your account has been successfully changed.";

	}
} else {
	echo "<br>This function does not exist.";
}
}
?>
</center>