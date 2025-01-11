<?php

echo '

<h2 class="ico_mug">Rage Reset</h2>
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
if(stristr($_SERVER['PHP_SELF'], 'rage.php')){
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
$query = $db->Execute("SELECT
					Player.UID,
		                        Player.PID,
                                        Player.Name
From Player
					 WHERE 
					 UID = '".$_SESSION['kal_id']."' And  
									Rage	!= '617142' ORDER BY Player.Level DESC
 ");
for($i=0;$i < $query->numrows();++$i)
{
$row = $query->fetchrow();
$Names = $row[2];
$Name = str_replace('<', '&lt;', $Names);
if($top == 1){
echo'&nbsp;&nbsp;<b><font color="#676767" size="2">Select your character </font></b><br><br>';
}
echo '<form action="?page=rage&amp;go=reset" method="post" >
&nbsp;&nbsp;<input type="radio" value="'.htmlspecialchars($row[1]).'" name="PID" class="noborder" onClick="chMd()"/>&nbsp;<font size="2">'.$Name.'</font><br><br>';
$top++;
}
If(empty($Name)){
echo $errorstyle1.'All characters on your account have full rage.'.$errorstyle2;
}
else {	
echo'

&nbsp;&nbsp;<input name="goServer" value="Reset Now" id="saves" disabled="disabled" type="submit">

</form>';
echo '	<br><font color="red" size="2"><b><center>( You must be offline in game )</b></font></center>';
}
;echo '



';
break;
case'reset':
$PID = $_POST['PID'];
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
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$_SESSION['kal_id']."' ORDER BY Date desc");
$rs = $checks->fetchrow();
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$playercheck	=    $db->Execute("SELECT Player.Name,Player.PID,Player.Rage

				FROM
					Player
				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."'
			      ");
$r = $playercheck->fetchrow();
$Names = $r[0];
$Name = str_replace('<', '&lt;', $Names);
$pid = $r[1];
$rage = $r[2];
if(empty($pid)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You are not owner of this character.")
		window.location = "index.php";
</SCRIPT>';
exit();
} 
else if($rs[0] == '0')
{
echo $errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2;
} else
if(($rage == '617142')){
echo$errorstyle1.'Character ['.$Name.'] already had full rage.'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">';
}
else {
$unstuck = $db->Execute("UPDATE	Player
								SET
									Rage = 617142

								
					WHERE 
					 UID = '".$_SESSION['kal_id']."' And PID = '$PID'
									
								
");
echo$successstyle1.'Character ['.$Name.'] got full rage successfully.'.$successstyle2;
}
} 
break;
}
}
;echo '








';?>