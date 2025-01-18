<?php	                                       	                                       	                                     			
include("import.php");
echo "<center>";
$login = checkLoggedin($con);
if($login == true)
{
	$result2 = mssql_query("SELECT * FROM account.dbo.privacy WHERE uid = '".$userno."'",$con);
	$row1 = mssql_num_rows($result2);
	if($row1 != 0)
	{
		echo "Disabled!<br>";
		mssql_query("delete account.dbo.privacy where uid = '".$userno."'",$con);
	}
	else
	{
		echo "Enabled!<br>";
		mssql_query("INSERT INTO account.dbo.privacy (uid) VALUES ('".$userno."')",$con);
	}

}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=privacy'>";
}
echo "<a href='login.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
