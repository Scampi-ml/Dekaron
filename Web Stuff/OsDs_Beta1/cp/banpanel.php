<?php
/*The ban managing page by Zombe.*/
include "connect.php";

//$IP=$_SERVER["REMOTE_ADDR"];
//$allow="SELECT * from allowed where IP='$IP'";
//$allow2=mysql_query($allow);
//while($allow3=mysql_fetch_array($allow2))
//{
//	$allowed=$allow3[IP];
//}
//
//if ($allowed)
//{
//}
//else
//{
//	print "You have no access to the ban management panel";
//    die();
//}

echo'<Form Name ="form0" Method ="POST">';
echo'Enter account name <p>';
echo'<input name="name" type="text" id="spam" value="">';
echo'<input name="submit" type="submit" value="Get the IP!">';
$account4ip = $_POST['name'];

$result1 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '$account4ip'",$link);
$row1 = mssql_fetch_row($result1);
$usersip = "$row1[6]";

if ($usersip)
{
    echo "<p>The account was registered on IP $usersip";
}
elseif ($account4ip)
{
	echo '<p>There is no such account.';
}
echo '</form0>';

echo'<Form Name ="form1" Method ="POST">';
echo'Enter the IP you would like to ban. <p>';
echo'<input name="iptoban" type="text" value="">';
echo'<input name="banhim" type="submit" value="Ban him!">';
$iptoban = $_POST['iptoban'];
$iptobanlong = ip2long($iptoban);

if ($iptoban != "")
{
    $ipbancheck="SELECT * from banip where ip2long='$iptobanlong'";
    $ipbancheck2=mysql_query($ipbancheck);
    while($ipbancheck3=mysql_fetch_array($ipbancheck2))
    {
        $IPBANNED=$ipbancheck3[IP];
    }
    if ($IPBANNED)
    {
	    print "<p>This IP is already banned.";
    }
    else
    {
	    $banq="INSERT INTO banip(IP, ip2long) VALUES ('$iptoban', '$iptobanlong')";
        $banq2=mysql_query($banq);
	    echo ("<p>Banned!");
    }
}
echo'</form1>';


echo'<Form Name ="form2 Method ="POST">';
echo'Enter the IP you would like to un-ban. <p>';
echo'<input name="iptounban" type="text" value="">';
echo'<input name="unbanhim" type="submit" value="Un-ban him!">';
$iptounban = $_POST['iptounban'];
$iptounbanlong = ip2long($iptounban);

if ($iptounban != "")
{
    $ipbancheck="SELECT * from banip where ip2long='$iptounbanlong'";
    $ipbancheck2=mysql_query($ipbancheck);
    while($ipbancheck3=mysql_fetch_array($ipbancheck2))
    {
        $IPBANNED=$ipbancheck3[IP];
    }
    if ($IPBANNED)
    {
	 	$unbanq="DELETE FROM banip WHERE ip2long= '$iptounbanlong'";
        $unbanq2=mysql_query($unbanq);
	    echo ("<p>Un-banned!");   
    }
    else
    {
		print "<p>This IP is not banned.";
    }
}
echo'</form2>';
?>