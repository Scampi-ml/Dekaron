<?php	                                       				                                       	                                     			
include("import.php");
echo "<center>";
$login = checkLoggedin($con);

if($login == true)
{
	$result2 = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '".$userno."' and (wMapIndex = 64 or wMapIndex = 16)",$con);
	$row1 = mssql_num_rows($result2);
	if($row1 != 0)
	{
		echo "You can't leave the prison!<br>";
	}
	else
	{
		echo "You've been moved back to Loa<br>";
		mssql_query("update character.dbo.user_character SET wMapIndex = 7, wPosX = 282, wPosY = 219 where user_no = '".$userno."'",$con);
	}
}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=unstuck'>";
}
echo "<a href='login.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
