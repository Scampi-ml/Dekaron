<?php	                                       				                                       	                                     			
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($_POST['activ'] == '1' && $login == true)
{
	$accnewpass = anti_injection($_POST['accnewpass']);
	$accnewpass2 = md5($accnewpass);
	$accpass = $accnewpass2;
	mssql_query("UPDATE account.dbo.user_profile SET user_pwd = '".$accnewpass2."' WHERE user_no = '".$userno."'", $con);
	mssql_query("UPDATE account.dbo.tbl_user SET user_pwd = '".$accnewpass."' WHERE user_no = '".$userno."'", $con);
	echo "Password changed to ".$accnewpass;

} 
else if($login == true)
{
	
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u><font color = white>Password Change<font></u></b></td></tr>";
	echo "<tr><td><font color=white>New Password</font></td><td><input type='password' name='accnewpass' maxlength='12'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'>
		<input type='hidden' name='activ' value='1'>
		<input type='submit' value='Change Password'></td></tr>";
	echo "</table></center>";
	echo "</form>";

}
else if($login == false)
{
echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=passchange'>";

}
echo "<br><a href='login.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
