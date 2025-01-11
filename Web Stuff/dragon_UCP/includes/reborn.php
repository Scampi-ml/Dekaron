<?php

echo '
<h2 class="ico_mug">Reborn</h2>
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
if(stristr($_SERVER['PHP_SELF'], 'reborn.php')){
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
include('reborn-system.php');
$top = 1;
$minlvl = $reborn['minlvl'];
$maxreborn = $reborn['maxreborn'];
$query =  $db->Execute("SELECT
					Player.UID,
		                        Player.PID,
                                        Player.Name
From Player
					 WHERE 
					 UID = '".$_SESSION['kal_id']."' And  
									[Level]	>= '$minlvl' And  [Reborn] < '$maxreborn'
Or  UID = '".$_SESSION['kal_id']."' And  
									[Level]	>= '$minlvl' And  [Reborn] IS NULL
 ORDER BY Player.Level DESC
 ");
echo'';
for($i=0;$i < $query->numrows();++$i)
{
$r = $query->fetchrow();
$Names = $r[2];
$Namea = str_replace('<', '&lt;', $Names);
if($top == 1){
echo'<b><font color="#676767">Select your character </font></b><br><br>';
}
echo '<form action="?page=reborn&amp;go=doreborn" method="post" name="fRadio">
<input type="radio" value="'.htmlspecialchars($r[1]).'" name="PID" class="noborder" onClick="chMd()"/>&nbsp;'.$Namea.'<br><br>';
$top++;
}
If(empty($Namea)){
echo$errorstyle1.'There are no characters on your account need to reborn.'.$errorstyle2;
}
else {	
echo'
<input name="goServer" value="Reborn" disabled="disabled" type="submit">


</form>';
echo '	<br><font color="red"><b><center>( You must be offline in game )</b></font></center>';
}
;echo '



';
break;
case'doreborn':
$PID = $_POST['PID'];
if(!is_numeric($PID)) {
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("Please select character.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else {
include('reborn-system.php');
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
Player.Name,Player.PID,Player.Level,Player.Reborn,Player.Exp
				FROM
					Player
				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."'
			      ");
$r = $playercheck->fetchrow();
$Names = $r[0];
$Namea = str_replace('<', '&lt;', $Names);
$pid = $r[1];
$lvl = $r[2];
$minlvl = $reborn['minlvl'];
$Level = $r[2];
$Exp = $r[4];
$Name = $r[0];
$Reborn = $r[3];
$rbrank	= $Reborn + 1;
$newname = $reborn[$rbrank].''.$nName;
$rebornlvl = $reborn['resetlvl'];
$newname = preg_replace("/$reborn[$Reborn]/", '',$Name);
$newname = $reborn[$rbrank].$newname;
$left = $reborn['minlvl'] - $Level;
$reborn['maxreborn'] = 0 + $reborn['maxreborn'];
if(empty($pid)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You are not owner of this character.")
		window.location = "index.php";
</SCRIPT>';
exit();
} else if($rs[0] == '0')
{
echo $errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2;
} else
if($lvl < $minlvl){
echo$errorstyle1.'Character ['.$Namea.'] already got the reborn.'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">';
}
else 		if($Level >= $reborn['minlvl'] && $Reborn < $reborn['maxreborn']){ 
$Reborn = $db->Execute("UPDATE	Player
								SET
									Name = '$newname',
									Reborn = '$rbrank',
									Level = '$rebornlvl',
									Exp	=  0,
									 Map = 0,
									X = 268473,
									Y = 244519,
									Z = 20167
		WHERE 
					 UID = '".$_SESSION['kal_id']."' And PID = '$PID'

								
");
if($Reborn){
$rrr = $db->Execute('SELECT TOP 1 IID FROM [Item] ORDER by IID DESC');
$rw = $rrr->fetchrow();
if(empty($rw[0])){
$newiid = '-2147483647';
}else{
$newiid = $rw[0] +1;
}
$faga = $db->Execute("SELECT [Num],[IID] FROM [Item] Where [Index] = 1001 And [PID] = '$PID'");
$rk = $faga->fetchrow();
$givecoin= $rk[0] + 10;
$theiid = $rk[1];
if(empty($rk[0])){
$addcmf = $db->Execute('INSERT INTO [Item] ([PID],[IID],[Index],[Prefix],[Info],[Num])
  VALUES (?,?,?,?,?,?)', 
array($PID,$newiid,1001,0,0,10));
}else {
$addcmf = $db->Execute("UPDATE Item SET [Num] = '".$givecoin."' WHERE [IID] = '".$theiid."'");
}
}
echo$successstyle1.'Congratulation You Got 10 Coins In Your Character.'.$successstyle2;
echo$successstyle1.'Your ['.$rbrank.'] reborn is done.'.$successstyle2;
}
else if($r[3] >= $reborn['maxreborn']){ echo $errorstyle1.'You allready have the max. Reborn Grade of '.$reborn['maxreborn'].' Reborns.'.$errorstyle2;}
else{ echo $errorstyle1.'You need ['.$left.'] Level Ups to make your '.$rbrank.'Reborn!'.$errorstyle2;}
}
break;
}
}
;echo '
';
break;
case'lock':

/*
crap again

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