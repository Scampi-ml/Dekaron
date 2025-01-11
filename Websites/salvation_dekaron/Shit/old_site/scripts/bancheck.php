<?php
/*The ban checking page by Zombe.*/
mysql_connect("localhost", "xplic_ban_info", "player14") or die(mysql_error()); // MYSQL IP , user  and password. Do not remove the quotes!
mysql_select_db("xplicit_ban_info") or die(mysql_error());

$IP=$_SERVER["REMOTE_ADDR"];
$ipbancheck="SELECT * from banip where IP='$IP'";
$ipbancheck2=mysql_query($ipbancheck);
while($ipbancheck3=mysql_fetch_array($ipbancheck2))
{
    $IPBANNED=$ipbancheck3[IP];
}
if ($IPBANNED)
{
    print "You have been banned";
    die();
}
?>