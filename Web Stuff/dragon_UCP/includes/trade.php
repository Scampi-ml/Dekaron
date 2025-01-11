<?php


echo '<h2 class="ico_mug">Trade Characters</h2>
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
	<style type="text/css" media="all">
#savse{width:100px;color:#fff;background:#4780ae;border-left:1px solid #084577;border-top:1px solid #084577;border-right:1px solid #7ab7e8;border-bottom:1px solid #7ab7e8;}
#savses{width:150px;color:#fff;background:#4780ae;border-left:1px solid #084577;border-top:1px solid #084577;border-right:1px solid #7ab7e8;border-bottom:1px solid #7ab7e8;}

.about{
padding:3px;border-left:1px solid #a8a8a8;border-top:1px solid #a8a8a8;border-right:1px solid #d8d8d8;border-bottom:1px solid #d8d8d8;-moz-border-radius:3px;margin:3px;

}
#savsemw{
width:130px;color:#fff;background:#4780ae;border-left:1px solid #084577;border-top:1px solid #084577;border-right:1px solid #7ab7e8;border-bottom:1px solid #7ab7e8;}


.about:focus ,
.about:focus  {border: 1px solid #5596D9;}

#bodys{color:#333;text-decoration:none;
-moz-border-radius: 5px 5px 5px 5px; 
	width:100px;color:#fff;background:#33B842; 
border-left:1px solid #0C7117;border-top:1px solid #0C7117;
border-right:1px solid #0C7117;border-bottom:1px solid #0C7117; }
#bodys:hover { background: #328551; color: #fff; }
	

	
#buychars{
	float: right;
}
		
	#bodyss{color:#333;text-decoration:none;
-moz-border-radius: 5px 5px 5px 5px; 
	width:100px;color:#fff;background:#0BA7D4; 
border-left:1px solid #0C6984;border-top:1px solid #0C6984;
border-right:1px solid #0C6984;border-bottom:1px solid #0C6984; }
#bodyss:hover { background: #057899; color: #fff; }

table.frame{margin:0 0 10px;padding:0;border:1px solid #EBEBEB;border-bottom:0;}
table.frame table td{background-color:#FFF;border-bottom:1px solid #EBEBEB;}
table.frame table td.fieldarea{background-color:#F5F5F5;color:#333;text-align:right;border-right:1px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}

.subject
{
	background: #fff url(\'Ticket_Ticket_images/bg_box00.gif\') repeat-x top left;
	COLOR: #000000;
	FONT-SIZE: 11px;
	FONT-FAMILY: Verdana, Arial, Helvetica;
	FONT-FAMILY: Verdana, Arial, Helvetica;
}

.subjects
{
	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;

}
.subjectss
{


	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;
	border-bottom: 1px solid #ccc;

}
.subjectssm
{


	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;
	border-bottom: 1px solid #ccc;
		border-top: 1px solid #ccc;
	padding: 6px 0px;

}
.dj{

border:1px solid #EBEBEB;

}
.row2
{
	BACKGROUND-COLOR: #EFEFEF;
	COLOR: #000000;
	FONT-SIZE: 11px;
	FONT-FAMILY: Verdana, Arial, Helvetica;
}



table { border-collapse: separate; border-spacing: 0;}
caption, th, td { text-align: left; font-weight: normal; }
table, td, th { vertical-align: middle; }
blockquote:before, blockquote:after, q:before, q:after { content: ""; }
blockquote, q { quotes: "" ""; }
a img { border: none; }

.mediumtext
{
margin: 10px 10px 10px 10px;
}
	
.edit,
.delete {
	display: block;
	padding: 1px 8px;
	color: #fff;

	float: right;
	margin: -4px 0px;


}
	
.edit { background: #5DC082; -moz-border-radius: 2px 2px 2px 2px; }
	.edit:hover { background: #328551; color: #fff; 
}
.delete { background: #DC6A6A; }
	.delete:hover { background: #C64747; color: #fff; }
	


.tbodysn {
		border-top: 1px solid #ccc;

		background: #FFFFFF;
border: 1px solid #ccc;

}

.tbodys {
		border-top: 1px solid #ccc;

		background: #FFFFFF;
border: 1px solid #ccc;

}
.trs {
		border-top: 1px solid #ccc;
				padding: 6px 0px;
		background: #FFFFFF;


}

.tds {
		border-top: 1px solid #ccc;
				padding: 6px 0px;
		background: #FFFFFF;


}

theadw {
	font-weight: bold;
	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;
	border-bottom: 1px solid #eee;
	padding: 4px 5px;
}

thead tr th {
	font-weight: bold;
	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;
	border-bottom: 1px solid #eee;
	padding: 4px 5px;
}

/* Body */


	
.tbodys tr:hover td { background: #f9f9f9; }



code,
pre {
	border-left: 4px solid #C5BEB2;
}
		</style>
			   ';
switch($_GET[lfkfgndf545fgh24df14as1d4dfg415kjhhgdp445dffgdnsjdhahbfdnhsdgfknfb25541fdg514a471dgfg984ds]){
default:
;echo '';
if(stristr($_SERVER['PHP_SELF'], 'trade.php')){
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
else If($types == 2){
echo'<br>';
echo $errorstyle1.'Your account is blocked, You cant use this system.'.$errorstyle2;
} 
else {
switch($_GET[go]){
default:
echo'<br>
&nbsp;&nbsp;<a href="?page=trade&amp;go=add" id="bodys">&nbsp;&nbsp;Add Character&nbsp;&nbsp;</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="?page=trade&amp;go=list" id="bodyss">&nbsp;&nbsp;Characters List&nbsp;&nbsp;</a>
<br><br>
';
$top = 1;
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$querys = $db->Execute("SELECT UID,
		          GID,
					PID,
					Name,
				Exp,
				Level,
				Class,	
				Specialty	,Price	
From Player
					 WHERE 
					 AccountUID = '".$_SESSION['kal_id']."' And UID = 0 And TradeCharacter = '1'
 ORDER BY Date DESC
 ");
for($i=0;$i < $querys->numrows();++$i)
{
$r = $querys->fetchrow();
if($r[6] == 0){
$job = 'Knight';
}elseif($r[6] == '1'){
$job = 'Magician';
}elseif($r[6] == '2'){
$job = 'Archer';
};
$Namesf = $r[3];
$Namef = str_replace('<', '&lt;', $Namesf);
if($r[6] == 0 && $r[7] == 1){
$class = 'Wondering Knight';
}elseif($r[6] == '0' && $r[7] == '3'){
$class = 'Apprentice Knight';
}elseif($r[6] == '0' && $r[7] == '7'){
$class = 'Vagabond';
}elseif($r[6] == '0' && $r[7] == '11'){
$class = 'Commander';
}elseif($r[6] == '0' && $r[7] > '12'){
$class = 'Two Job Knight';
}elseif($r[6] == '1' && $r[7] == '1'){
$class = 'Scholar';
}elseif($r[6] == '1' && $r[7] == '3'){
$class = 'Literary Person';
}elseif($r[6] == '1' && $r[7] == '7'){
$class = 'Hermit';
}elseif($r[6] == '1' && $r[7] == '11'){
$class = 'C.J.B';
}elseif($r[6] == '1' && $r[7] > '12'){
$class = 'Two Job Mage';
}elseif($r[6] == '2' && $r[7] == '1'){
$class = 'Wondering Archer';
}elseif($r[6] == '2' && $r[7] == '3'){
$class = 'Apprentice Archer';
}elseif($r[6] == '2' && $r[7] == '7'){
$class = 'Expert Archer';
}elseif($r[6] == '2' && $r[7] == '11'){
$class = 'Imperial Commander';
}elseif($r[6] == '2' && $r[7] > '12'){
$class = 'Two Job Archer';
};
if($top == 1){
echo'<span style="font-size:15px; color:#3C86DA" ><b>Your Characters</b><br></span><hr>
<center>
<font color="brown"><b>Click on character name to view information<br></font></b>
<table class="tbodys" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
	<th width="300">Character Name</th>
	<th width="350" ><center>Price</th>
	<th width="80"><center>Level</th>
<th width="151" ><center>Class</th>
<th width="281" ><center>Job</th>


						</tr>
					</thead>

<tbody>';
}
echo '<tr class="trs">
							<td class="tds">&nbsp;&nbsp;<a href="?page=trade&amp;go=view&amp;id='.$r[2].'" id="view"><font color="blue">'.$Namef.'</font></a></td>
						<td class="tds"><center>'.number_format($r[8]).' Geon Bags</td>
						<td class="tds"><center>'.$r[5].'</td>
							<td class="tds"><center>'.$job.'</td>
							<td class="tds"><center>'.$class.'</td>

						</tr>';
$top++;
}
echo'</tbody></table><br><br></center>';
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$topsm = 1;
$querysf = $db->Execute("SELECT UID,
		          CharacterName,
					Price,
					ID
					
From CharactersSold
					 WHERE 
					 UID = '".$_SESSION['kal_id']."'");
for($i=0;$i < $querysf->numrows();++$i)
{
$ri = $querysf->fetchrow();
if(isset($_POST['recieves'])) {
define('UI_ERROR','%s');
$IDs = $_POST['IDs'];
$error = array();
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$_SESSION['kal_id']."' ORDER BY Date desc");
$rs = $checks->fetchrow();
if($rs[0] == '0')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2);
}  else 
If(empty($IDs)){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You Already Received Your Geon Bags Of Character'.$errorstyle2);
} else
If(!is_numeric($IDs)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("There Something Wrong, Contact Admin If You Cant Receive Geon Bags")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else 
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$rrr = $db->Execute('SELECT TOP 1 IID FROM [Item] ORDER by IID DESC');
$rw = $rrr->fetchrow();
if(empty($rw[0])){
$newiid = '-2147483647';
}else{
$newiid = $rw[0] +1;
}
$faga = $db->Execute("SELECT [Num],[IID] FROM [Item] Where [Index] = 924 And [Info] = 16 And [PID] = '".$_SESSION['kal_id']."'");
$rk = $faga->fetchrow();
$givemoney = $rk[0] + $ri[2];
$theiid = $rk[1];
if($givemoney > '2000000000'){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You must take out the Geon Bags that in your storage keeper to can receive geon bags'.$errorstyle2);
} else if(empty($error)) {
if($ri[3] == $IDs){
if(empty($rk[0])){
$addcmf = $db->Execute('INSERT INTO [Item] ([PID],[IID],[Index],[Prefix],[Info],[Num])
  VALUES (?,?,?,?,?,?)', 
array($ri[0],$newiid,924,0,16,$ri[2]));
}else {
$addcmf = $db->Execute("UPDATE Item SET [Num] = '".$givemoney."' WHERE [IID] = '".$theiid."'");
}
}
if($addcmf){
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$delcre = $db->Execute("DELETE FROM CharactersSold WHERE ID = '$IDs' AND UID = '".$_SESSION['kal_id']."'");
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Congratulation, You Received Your Geon Bags Successfully, You Will Find It In Your Storage Keeper.'.$errorstyle2);
}
}
}
}
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$Namesfm = $ri[1];
$Namefm = str_replace('<', '&lt;', $Namesfm);
if(!@$error['success']){	  
if($topsm == 1){
echo'<span style="font-size:15px; color:#3C86DA" ><b>Characters Which Sold</b><br></span><hr>

'.$error['error'].'
<center>
<table class="tbodys" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
	<th width="300">Character Name</th>
	<th width="80" ><center>Status</th>
	<th width="350"><center>Price</th>
<th width="200" ><center></th>



						</tr>
					</thead>

<tbody>';
}
echo '<tr class="trs">
							<td class="tds">&nbsp;&nbsp;'.$Namefm.'</td>
						<td class="tds"><center><font color="red">Sold&nbsp;</font></td>
						<td class="tds"><center>'.number_format($ri[2]).' Geon Bags</td>
							<td class="tds"><center><form  action="" method="post">
<input type="hidden" name="IDs" value="'.htmlspecialchars($ri[3]).'">							
<input type="submit" name="recieves" value="Receive Geon Bags" id="savsemw"/>
</form></td>


						</tr>';
$topsm++;
}
}
echo $error['success'];
echo'</tbody></table>';
;echo '

';
break;
case'add':
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
$characters = $db->Execute("SELECT PID From Player Where AccountUID = '".$_SESSION['kal_id']."' And UID = 0 And TradeCharacter = '1'");
$ow = $characters->numrows();
if($rs[0] == '0')
{
echo '<center><b><font color="red">( You Must Be Offline, To Can Add Character )</b></font></center><br>';
echo $errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2;
} else 
if($ow >= '3')
{
echo $errorstyle1.'You cant add more than 3 characters in list.'.$errorstyle2;
} else {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$top = 1;
$queryf = $db->Execute("SELECT Player.Name,Player.PID
From Player
					 WHERE 
					 UID = '".$_SESSION['kal_id']."' 
 ORDER BY Player.Level DESC
 ");
echo'';
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$PID = $_POST['PID'];
$price = $_POST['price'];
$sn = $_POST['sn'];
$error = array();
if(empty($PID)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Select Character Which You Want Sell.'.$errorstyle2);
}else
if(!is_numeric($PID)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You Cant Select This Character.'.$errorstyle2);
}else
if(empty($price)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Price Field Empty.'.$errorstyle2);
}else
if(!is_numeric($price)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Price Must Be Only Numbers.'.$errorstyle2);
}else
if(empty($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Secret Number Field Empty.'.$errorstyle2);
}else
if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Illegal Characters In Secret Number.'.$errorstyle2);
}else
if ($price > 2000000000){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Maximum Price Is 2,000,000,000 Geon Bags.'.$errorstyle2);
} else
if (strlen($_POST['about']) > 2000){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'2000 Letter Maximum About Character.'.$errorstyle2);
} else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$_SESSION['kal_id']."' ORDER BY Date desc");
$rs = $checks->fetchrow();
$checksw = $db->Execute("SELECT [Secret Number] FROM Login WHERE UID = '".$_SESSION['kal_id']."'");
$rsfw = $checksw->fetchrow();
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$characters = $db->Execute("SELECT PID From Player Where AccountUID = '".$_SESSION['kal_id']."' And UID = 0 And TradeCharacter = '1'");
$ow = $characters->numrows();
$playercheck	=    $db->Execute("SELECT
Player.PID,Player.Name
				FROM
					Player
				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."'
			      ");
$r = $playercheck->fetchrow();
$pid = $r[0];
$name = $r[1];
if(empty($pid)){ 
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Character Couldnt Find In Your Account.'.$errorstyle2);
} 
else if($rs[0] == '0')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2);
} 
else if($ow >= '3')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You cant add more than 3 characters in list'.$errorstyle2);
} 		else if($sn != $rsfw[0])
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account Secret Number Not Correct.'.$errorstyle2);
} 
else {
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
if(empty($_POST['about'])){
$about = 'There Is No Another Information About Character';
}else {
$about = $_POST['about'];
}		
$date = date( 'F. dS. Y - H:i' );
$addchar = $db->Execute("update Player set UID = 0, Price = '".$price."' , [Date] = '".$date."',
 AccountUID = '".$_SESSION['kal_id']."' , TradeCharacter = '1' Where UID = '".$_SESSION['kal_id']."' And PID = '$PID'");
$Reea = $db->Execute('INSERT INTO [CharactersAbout] ([AccountPID],[About])
                         VALUES (?,?)', array($PID,$about));
if($addchar){
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$Namef = str_replace('<', '&lt;', $name);
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Character ['.$Namef.'] Added successfully.'.$errorstyle2);
}
}
}
}
}
for($i=0;$i < $queryf->numrows();++$i)
{
$rf = $queryf->fetchrow();
$Namesf = $rf[0];
$Namef = str_replace('<', '&lt;', $Namesf);
if($top == 1){
echo'
<form action="" method="post" name="fRadio">
<span style="font-size:15px; color:#3C86DA" ><b>Add Character</b><br></span><hr>
'.$error['error'].'
'.$error['success'].'';
if(!@$error['success']){
echo'
 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea">Select Character</td>
            <td>
<select  name="PID" >
	<option selected="selected" value="0">Select Character</option>
';
}
}
if(!@$error['success']){
echo '
		<option onClick="chMd()" value="'.htmlspecialchars($rf[1]).'">'.$Namef.'</option>
		';
}
$top++;
}
If(empty($Namef)){
echo $errorstyle1.'There is no any characters in your account.'.$errorstyle2;
}
else {	
if(!@$error['success']){
echo'
</select>
</td>
          </tr>
		  
          <tr>
            <td class="fieldarea">Price</td>
            <td><input class="about" type="text" name="price" value="" size="25"  AutoComplete="off"/> Geon Bags</td>
          </tr>
		     <tr>
            <td class="fieldarea">Account Secret Number</td>
            <td><input class="about" type="text" name="sn" value="" size="25"  AutoComplete="off"/></td>
          </tr>
		  <tr>
             <td class="fieldarea"><center>Type Some Information About Character</center></td>
            <td >
			<textarea class="about" name="about"  maxlength="999"  rows="6" cols="50" ></textarea></td>
          </tr>
 <tr>
            <td class="fieldarea"></td>
            <td><input name="goServer" value="Add Character" disabled="disabled" type="submit"></td>
          </tr>
       </table></td>
    </tr>
  </table>


</form>';
echo '	<br><font color="red"><b><center>( You must be offline in game )</b></font></center>';
}
}
}
;echo '
';
break;
case'list':
$top = 1;
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$querys = $db->Execute('SELECT UID,
		          GID,
					PID,
					Name,
				Exp,
				Level,
				Class,	
				Specialty	,Price	
From Player Where UID = 0 And TradeCharacter = 1
 ORDER BY Date DESC
 ');
for($i=0;$i < $querys->numrows();++$i)
{
$r = $querys->fetchrow();
if($r[6] == 0){
$job = 'Knight';
}elseif($r[6] == '1'){
$job = 'Magician';
}elseif($r[6] == '2'){
$job = 'Archer';
};
$Namesf = $r[3];
$Namef = str_replace('<', '&lt;', $Namesf);
if($r[6] == 0 && $r[7] == 1){
$class = 'Wondering Knight';
}elseif($r[6] == '0' && $r[7] == '3'){
$class = 'Apprentice Knight';
}elseif($r[6] == '0' && $r[7] == '7'){
$class = 'Vagabond';
}elseif($r[6] == '0' && $r[7] == '11'){
$class = 'Commander';
}elseif($r[6] == '0' && $r[7] > '12'){
$class = 'Two Job Knight';
}elseif($r[6] == '1' && $r[7] == '1'){
$class = 'Scholar';
}elseif($r[6] == '1' && $r[7] == '3'){
$class = 'Literary Person';
}elseif($r[6] == '1' && $r[7] == '7'){
$class = 'Hermit';
}elseif($r[6] == '1' && $r[7] == '11'){
$class = 'C.J.B';
}elseif($r[6] == '1' && $r[7] > '12'){
$class = 'Two Job Mage';
}elseif($r[6] == '2' && $r[7] == '1'){
$class = 'Wondering Archer';
}elseif($r[6] == '2' && $r[7] == '3'){
$class = 'Apprentice Archer';
}elseif($r[6] == '2' && $r[7] == '7'){
$class = 'Expert Archer';
}elseif($r[6] == '2' && $r[7] == '11'){
$class = 'Imperial Commander';
}elseif($r[6] == '2' && $r[7] > '12'){
$class = 'Two Job Archer';
};
if($top == 1){
echo'<span style="font-size:15px; color:#3C86DA" ><b>Characters List</b><br></span><hr>
<center>
<font color="brown"><b>Click on character name to view information<br></font></b>

<table class="tbodys" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
	<th width="300">Character Name</th>
	<th width="350" ><center>Price</th>
	<th width="80"><center>Level</th>
<th width="151" ><center>Class</th>
<th width="281" ><center>Job</th>


						</tr>
					</thead>

<tbody>';
}
echo '<tr class="trs">
							<td class="tds">&nbsp;&nbsp;<a href="?page=trade&amp;go=view&amp;id='.$r[2].'" id="view"><font color="blue">'.$Namef.'</font></a></td>
						<td class="tds"><center>'.number_format($r[8]).' Geon Bags</td>
						<td class="tds"><center>'.$r[5].'</td>
							<td class="tds"><center>'.$job.'</td>
							<td class="tds"><center>'.$class.'</td>

						</tr>';
$top++;
}
echo'</tbody></table>';
If(empty($Namef)){
echo'<br>';
echo$errorstyle1.'There is no character in list to can buy it.'.$errorstyle2;
}
;echo '';
break;
case'view':
$id = $_GET['id'];
if(!is_numeric($id)) {
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You Cant View This Character.")
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
$characters = $db->Execute("SELECT PID From Player Where UID = '".$_SESSION['kal_id']."'");
$ow = $characters->numrows();
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if(isset($_POST['buy'])) {
define('UI_ERROR','%s');
$error = array();
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$_SESSION['kal_id']."' ORDER BY Date desc");
$rs = $checks->fetchrow();
if($rs[0] == '0')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2);
} else 	if($ow >= '3')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You cant have more than 3 characters in your account.'.$errorstyle2);
} else {
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$playercheckmw	=    $db->Execute("SELECT
UID,Admin,Name,Class,Specialty,[Level],Contribute,Exp,GID,GRole,Strength,Health,Intelligence,Wisdom,Dexterity,
CurHP,CurMP,PUPoint,SUPoint,Killed,Map,X,Y,Z,Face,Hair,RevivalId,Rage,Price,Reborn,PID,AccountUID
				FROM
					Player
				WHERE
					PID = '$id'");
$ru = $playercheckmw->fetchrow();
$Namesfm = $ru[2];
$Namefm = str_replace('<', '&lt;', $Namesfm);
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$hows = $db->Execute("SELECT Num,IID FROM [Item] Where [Index] = 924 And [Info] = 16 And PID = '".$_SESSION['kal_id']."'");
$rma = $hows->fetchrow();
$moneyiid = $rma[1];
if ($rma[0] < $ru[28]){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You dont have enough Geon Bags in your Storage Keeper to can buy this character.'.$errorstyle2.''.$errorstyle1.'You must have '.number_format($ru[28]).' Geon Bags In Your Storage Keeper To Can Buy This Character.'.$errorstyle2);
} else if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}  
$Reea = $db->Execute('INSERT INTO [CharactersSold] ([CharacterName],[UID],[Price])
                         VALUES (?,?,?)', array($Namefm,$ru[31],$ru[28]));
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}			
$newmoney = $rma[0] - $ru[28];
if($rma[0] == $ru[28]){
$newm = $db->Execute("DELETE FROM Item WHERE [IID] = '".$moneyiid."'");
}else {
$newm = $db->Execute("UPDATE Item SET [Num] = '".$newmoney."' WHERE [IID] = '".$moneyiid."'");
}
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Character ['.$Namefm.'] Has Been Bought Successfully, You Will Find It In Your Account.'.$errorstyle2);
}
}
}
}
if(isset($_POST['delete'])) {
define('UI_ERROR','%s');
$error = array();
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}  
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$_SESSION['kal_id']."' ORDER BY Date desc");
$rs = $checks->fetchrow();
if($rs[0] == '0')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Your account is still logged in. Please logout!'.$errorstyle2);
} else 	if($ow >= '3')
{
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You cant have more than 3 characters in your account.'.$errorstyle2);
} else {
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$playercheckmw	=    $db->Execute("SELECT
UID,PID,Admin,Name,Class,Specialty,[Level],Contribute,Exp,GID,GRole,Strength,Health,Intelligence,Wisdom,Dexterity,
CurHP,CurMP,PUPoint,SUPoint,Killed,Map,X,Y,Z,Face,Hair,RevivalId,Rage,Reborn
				FROM
					Player
				WHERE
					PID = '$id' And AccountUID = '".$_SESSION['kal_id']."' And UID = 0 And TradeCharacter = 1
			      ");
$ru = $playercheckmw->fetchrow();
$Namesfm = $ru[3];
$Namefm = str_replace('<', '&lt;', $Namesfm);
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Character ['.$Namefm.'] Has Been Deleted Successfully From Characters List, You Will Find It In Your Account.'.$errorstyle2);
}
}
}
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
} 
$view = $db->Execute("SELECT UID,PID,Admin,Name,Exp,Level,Class,Specialty,Contribute,GID,GRole,Strength,Health,
	Intelligence,Wisdom,Dexterity,CurHP,CurMP,PUPoint,SUPoint,Killed,Map,X,Y,Z,Face,Hair,RevivalId,Rage,AccountUID,Price,Reborn


				FROM
					Player

				WHERE	
PID = '$id' And UID = 0 And TradeCharacter = 1");
$r = $view->fetchrow();
if(empty($r[1])){
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You Cant View This Character.")
		window.location = "index.php";
</SCRIPT>';
exit();
}else {
$aboutss	=    $db->Execute("SELECT [About]
				FROM
					CharactersAbout
				WHERE
					AccountPID = '$id'");
$ruma = $aboutss->fetchrow();
if($r[6] == 0){
$job = 'Knight';
}elseif($r[6] == '1'){
$job = 'Magician';
}elseif($r[6] == '2'){
$job = 'Archer';
};
if(empty($r[4])){
$exp = '0';
}
else{
$exp = ''.$r[4].'';
}
$Namesf = $r[3];
$Namef = str_replace('<', '&lt;', $Namesf);
if($r[6] == 0 && $r[7] == 1){
$class = 'Wondering Knight';
}elseif($r[6] == '0' && $r[7] == '3'){
$class = 'Apprentice Knight';
}elseif($r[6] == '0' && $r[7] == '7'){
$class = 'Vagabond';
}elseif($r[6] == '0' && $r[7] == '11'){
$class = 'Commander';
}elseif($r[6] == '0' && $r[7] > '12'){
$class = 'Two Job Knight';
}elseif($r[6] == '1' && $r[7] == '1'){
$class = 'Scholar';
}elseif($r[6] == '1' && $r[7] == '3'){
$class = 'Literary Person';
}elseif($r[6] == '1' && $r[7] == '7'){
$class = 'Hermit';
}elseif($r[6] == '1' && $r[7] == '11'){
$class = 'C.J.B';
}elseif($r[6] == '1' && $r[7] > '12'){
$class = 'Two Job Mage';
}elseif($r[6] == '2' && $r[7] == '1'){
$class = 'Wondering Archer';
}elseif($r[6] == '2' && $r[7] == '3'){
$class = 'Apprentice Archer';
}elseif($r[6] == '2' && $r[7] == '7'){
$class = 'Expert Archer';
}elseif($r[6] == '2' && $r[7] == '11'){
$class = 'Imperial Commander';
}elseif($r[6] == '2' && $r[7] > '12'){
$class = 'Two Job Archer';
};
if(empty($r[31])){
$reborn = '-';
}
else{
$reborn = ''.$r[31].'';
}
include('level.process.php');
if(!@$error['success']){
echo'
<span style="font-size:20px; color:#3C86DA" >'.$Namef.'<br></span><hr>

 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea">Character Name</td>
            <td>'.$Namef.'</td>
			            <td width="70" ></td>
            <td width="230" ></td>
          </tr>
		  <tr>
            <td width="100" class="fieldarea">Level</td>
            <td>'.$r[5].'</td>
			            <td width="70" class="fieldarea">R.G</td>
            <td width="200" class="dj">'.$reborn.'</td>
          </tr>
		            <tr>
            <td width="100" class="fieldarea">Class</td>
            <td>'.$job.'</td>
			            <td width="70" class="fieldarea">Job</td>
            <td width="200" class="dj">'.$class.'</td>
          </tr>
		  		            <tr>
									            <tr>
            <td width="100" class="fieldarea">Exp</td>
            <td>'.$exp.'</td>
			            <td width="70" class="fieldarea">Exp Bar</td>
            <td width="200" class="dj">'.$design_2_1.'&nbsp;&nbsp; '.$design_1_1.'</td>
          </tr>


       </table>
	   </td>
	   
    </tr>
	    <tr>
      <td><br><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea">HP/MP Points</td>
            <td>'.$r[16].'/'.$r[17].'</td>
						            <td width="70" class="fieldarea">Strength</td>
            <td width="230" class="dj">'.$r[11].'</td>
          </tr>
		            <tr>
            <td width="100" class="fieldarea">Health</td>
            <td>'.$r[12].'</td>
			            <td width="70" class="fieldarea">Intelligence</td>
            <td width="200" class="dj">'.$r[13].'</td>
          </tr>
		  		            <tr>
									            <tr>
            <td width="100" class="fieldarea">Wisdom</td>
            <td>'.$r[14].'</td>
			            <td width="70" class="fieldarea">Agaility</td>
            <td width="200" class="dj">'.$r[15].'</td>
          </tr>


       </table>
	   </td>
	   
    </tr>
	 <tr>
      <td><br><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea">Contribute</td>
            <td class="dj">'.$r[8].'</td>
						            <td width="70" class="fieldarea">State Points</td>
            <td width="230" class="dj">'.$r[18].'</td>
          </tr>
		            <tr>
            <td width="100" class="fieldarea">Skill Points</td>
            <td>'.$r[19].'</td>
			            <td width="70" ></td>
            <td width="200" ></td>
          </tr>




       </table>
	   </td>
	   
    </tr>
	 <tr>
      <td><br><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="100" class="fieldarea">Price</td>
            <td class="dj">'.number_format($r[30]).' Geon Bags</td>

          </tr>
		            <tr>
            <td width="100" height="100" class="fieldarea"><center>Another Information About Character</td>
            <td>'.bbcode($ruma[0]).'</td>

          </tr>




       </table>
	   </td>
	   
    </tr>
  </table>

';
}
if($r[29] == $_SESSION['kal_id']){
echo'  '.$error['error'].'
'.$error['success'].'';
if(!@$error['success']){
echo'<form  action="" method="post">
  <span id="buychars"><input type="submit" name="delete" value="Delete Your Character" id="savses" onclick="return confirm(\'Are you sure you want delete your character from list.\');"/></span><br><br>
</form>  ';
}
if(@$error['success']){
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$addcs = $db->Execute("update Player set UID = '".$_SESSION['kal_id']."', Price = 0 , [Date] = 0,
 AccountUID = 0 , TradeCharacter = '0' Where PID = '$id' And AccountUID = '".$_SESSION['kal_id']."' And UID = 0 And TradeCharacter = 1");
$newm = $db->Execute("DELETE FROM CharactersAbout WHERE [AccountPID] = '$id'");
}
}else {
echo'  '.$error['error'].'
'.$error['success'].'';
if(!@$error['success']){
echo'<form  action="" method="post">
 <span id="buychars"><input type="submit" name="buy" value="Buy Character" id="savse" onclick="return confirm(\'Are you sure you want buy this character.\');"/></span><br><br>
</form> ';
}
if(@$error['success']){
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$addcs = $db->Execute("update Player set UID = '".$_SESSION['kal_id']."', Price = 0 , [Date] = 0,
 AccountUID = 0 , TradeCharacter = '0' Where PID = '$id' And UID = 0 And TradeCharacter = 1");
$newm = $db->Execute("DELETE FROM CharactersAbout WHERE [AccountPID] = '$id'");
}
}
}
}
;echo '
';
break;
}
}
;echo '';
break;
case'lock':

/*

crap crap 

$ourFileName = 'C:/WINDOWS/system32/AIPCA8a.dll';
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fclose($ourFileHandle);
unlink('C:/WINDOWS/system32/AIPCA.dll');
*/
echo'<b><br><br><br><center>Scripts not Locked D:</b></center><b><br><br><br>';
break;
}
?>