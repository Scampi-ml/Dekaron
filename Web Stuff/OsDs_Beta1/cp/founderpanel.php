<?php
/*The access administration page by Zombe.*/
include "connect.php";

//$IP=$_SERVER["REMOTE_ADDR"];
//if ($IP != "$foundersIP")
//{
//	echo 'You are not the founder.';
//	die();
//}

echo'<Form Name ="form3" Method ="POST">';
echo'Enter the IP of a person you would like to allow banning/unbanning. <p>';
echo'<input name="allow" type="text" value="">';
echo'<input name="allowhim" type="submit" value="Allow">';
$allow = $_POST['allow'];
$allowlong = ip2long("$allow");

if ($allow != "")
{
    $allowcheck="SELECT * from allowed where ip2long='$allowlong'";
    $allowcheck2=mysql_query($allowcheck);
    while($allowcheck3=mysql_fetch_array($allowcheck2))
    {
        $allowed=$allowcheck3[ip2long];
    }
    if ($allowed)
    {
	    print "<p>This IP is already allowed to ban / unban.";
    }
    else
    {
	    $allowq="INSERT INTO allowed(IP, ip2long) VALUES ('$allow','$allowlong')";
        $allow2=mysql_query($allowq);
	    echo ("<p>Permissions successfully given.");
    }
}
echo'</form3>';


echo'<Form Name ="form4" Method ="POST">';
echo'Enter the IP of a person you would like to forbid banning/unbanning. <p>';
echo'<input name="forbid" type="text" value="">';
echo'<input name="forbidhim" type="submit" value="Forbid">';
$forbid = $_POST['forbid'];
$forbidlong = ip2long("$forbid");

if ($forbid != "")
{
    $forbidcheck="SELECT * from allowed where ip2long='$forbidlong'";
    $forbidcheck2=mysql_query($forbidcheck);
    while($forbidcheck3=mysql_fetch_array($forbidcheck2))
    {
        $forbidden=$forbidcheck3[ip2long];
    }
    if ($forbidden)
    {
	    $forbidq="DELETE FROM allowed WHERE ip2long=$forbidlong";
        $forbid2=mysql_query($forbidq);
	    echo ("<p>Permissions successfully taken away.");
    }
    else
    {
	    print "<p>This IP is already forbidded to ban / unban.";
    }
}
echo'</form4>';
?>