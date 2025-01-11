<?php

echo '
<h2 class="ico_mug">Guild Time Reset</h2>


<script type="text/javascript">
 function chMd()
 {

  document.forms[0].goServer.disabled=false;

  for(var i=0;i<document.forms[0].elements.length;i++)
  {
    if(document.forms[0].elements[i].name=="PID")
    {

       if(document.forms[0].elements[i].checked==true){


        document.forms[0].goServer.disabled=false;
       }
     
    }
  }
 }
</script>
';
if(stristr($_SERVER['PHP_SELF'], 'guildtime.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
else
if ($_SESSION['kal_login'] != 'yes'){
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You Must Login First.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else
if (!isset($_SERVER['HTTP_REFERER'])){die('<br><center>Direct access not allowed. Click <a href="index.php"><b>here</b></a> to back</font><br></center>');}
else
{
switch($_GET[go]){
default:
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$top = 1;
$query = $db->Execute("SELECT    Player.Name,Player.PID
FROM         Player INNER JOIN
                      GuildMember ON Player.PID = GuildMember.PID
WHERE     Player.UID = '".$_SESSION['kal_id']."'  AND GuildMember.GID = 0
ORDER BY Player.Level DESC
 ");
for($i=0;$i < $query->numrows();++$i)
{
$row = $query->fetchrow();
$Names = $row[0];
$Name = str_replace('<', '&lt;', $Names);
if($top == 1){
echo'&nbsp;&nbsp;<b><font color="#676767" size="2">Select your character </font></b><br><br>';
}
echo '<form action="?page=guildtime&amp;go=reset" method="post" name="fRadio">
&nbsp;&nbsp;<input type="radio" value="'.htmlspecialchars($row[1]).'" name="PID" class="noborder"  onClick="chMd()"/>&nbsp;<font size="2">'.$Name.'</font><br><br>';
$top++;
}
If(empty($Name)){
echo $errorstyle1.'All characters on your account have no guild waiting time.'.$errorstyle2;
}
else {	
echo'
<input  name="goServer" type="submit" value="Reset Now" id="saves" disabled="disabled"/>

</form><br>';
}
;echo '



';
break;
case'reset':
$PID = $_POST['PID'];
if(!is_numeric($PID)) {
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("Please select character.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$check_results = $db->Execute("SELECT Player.Name,Player.PID From Player Where UID = '".$_SESSION['kal_id']."' And PID = '$PID'");
$rows = $check_results->fetchrow();
$pid = $rows[1];
$Names = $rows[0];
$Name = str_replace('<', '&lt;', $Names);
$already_results = $db->Execute("SELECT GuildMember.GID,GuildMember.PID From GuildMember Where  PID = '$rows[1]'");
$rsa = $already_results->fetchrow();
if(empty($pid)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You are not owner of this character.")
		window.location = "index.php";
</SCRIPT>';
exit();
} else
if(!empty($rsa[0])){
echo $errorstyle1.'Character ['.$Name.'] already in guild.'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">';
} else
if(empty($rsa[1])){
echo $errorstyle1.'Guild waiting time already reseted in character ['.$Name.'].'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">';
}
else {
$reseted = $db->Execute("DELETE FROM GuildMember WHERE GID = 0 AND PID = '$PID'");
echo $successstyle1.'Guild waiting time has been reset succesfully in character ['.$Name.'] .'.$successstyle2;
}
} 
break;
}
}
?>