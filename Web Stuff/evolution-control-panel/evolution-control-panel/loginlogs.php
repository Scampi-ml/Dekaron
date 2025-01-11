<?php	                                       				                                       	                                     			
include("import.php");
echo "<center>";
$login = checkLoggedin($con);

if($login == true)
{
	echo "<table width='300' height='1'><tr valign='top'>";
	echo "<td width='5%'><b><font color = white>IP</font></b></td><td width='15%'><b><font color = white>Date</font></b></td></tr><tr valign='top'>";
	$getAccountLogins = mssql_query("SELECT ip,date FROM ban_info.dbo.account_login WHERE account LIKE '".$_SESSION['gdusername']."' ORDER by id DESC",$con);
	while($listLogins = mssql_fetch_array($getAccountLogins))
	{
		echo "<td width='5%'><font color = white>".$listLogins['ip']."</font></td>";
		echo "<td width='15%'><font color = white>".$listLogins['date']."</font></td></tr><tr>";
	}

}
else if($login == false)
{
	echo "<meta http-equiv='REFRESH' content='0;url=login.php?type=loginlogs'>";
}
echo "<a href='login.php' style='color: #00FF00'>Return to main page</a>";
echo "</center>";
echo "</font>";

?>
