<?php

echo '<h2 class="ico_mug">Friends List</h2>
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
.about{
padding:3px;border-left:1px solid #a8a8a8;border-top:1px solid #a8a8a8;border-right:1px solid #d8d8d8;border-bottom:1px solid #d8d8d8;-moz-border-radius:3px;margin:3px;

}

.about:focus ,
.about:focus  {border: 1px solid #5596D9;}

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


	
.tbodys tr:hover td { background: #F4F4F4; }


.readed{ 
		border-top: 1px solid #ccc;
				padding: 6px 0px;
		background: #F4F4F4; }
code,
pre {
	border-left: 4px solid #C5BEB2;
}


.pen { margin: -3px 0px; }
.posted { margin: -3px 0px; }


/*** page navigation ***/

.paa		{ float: right; margin: -20px 0px; min-width: 20px;  background: url("button_i.png") repeat-x center center #EEEEEE; text-align: center; border: 1px solid #dddddd; border-bottom: 1px solid #cccccc; color: #333333; text-decoration: none; -moz-border-radius: 2px 5px 2px 2px; -webkit-border-radius: 3px 3px 3px 3px; border-radius: 3px 3px 3px 3px; }
.pager			{ font-size: 11px; line-height: 20px; float: right;	margin: 5px;}
.pager a		{ display: block; float: left; }
.pager .nav		{ display: block; float: left; }
.pager .nav a		{ width: 20px; height: 20px; border: 1px solid #dddddd; border-bottom: 1px solid #cccccc; }
.pager .nav a span	{ display: block; font-size: 0%; visibility: hidden; text-indent: -9999px; }

.previous	{ background: url(\'Ticket_images/arrow_left.png\') center center no-repeat; border-left-width: 0px; -moz-border-radius: 3px 3px 3px 3px; -webkit-border-radius: 0px 3px 3px 0px; border-radius: 0px 3px 3px 0px; border: 1px solid #dddddd;}
.previous:hover	{ background: url(\'Ticket_images/arrow_left2.png\') center center no-repeat; }



.pager a.next		{ background: url(\'Ticket_images/arrow_right.png\') center center no-repeat; border-right-width: 0px; -moz-border-radius: 3px 3px 3px 3px; -webkit-border-radius: 3px 0px 0px 3px; border-radius: 3px 0px 0px 3px; border: 1px solid #dddddd;}
.pager a.next:hover	{ background: url(\'Ticket_images/arrow_right2.png\') center center no-repeat; }

.pager .pages 		{ display: block; float: left; margin: 0px 1px 3px 2px; font-weight: bold; }
.pager .pages a		{ min-width: 20px; margin: 0px 1px 0px 1px; background: url("button_i.png") repeat-x center center #EEEEEE; text-align: center; border: 1px solid #dddddd; border-bottom: 1px solid #cccccc; color: #333333; text-decoration: none; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 3px 3px 3px 3px; border-radius: 3px 3px 3px 3px; }
.pager .pages a	span	{ padding: 0px 2px 0px 2px; }
.pager .pages a:hover	{ background: url(\'Ticket_images/bck_whiu.png\'); color: #00A5C4; text-decoration: none; }
.pager .pages a.active	{ background: url(\'Ticket_images/page_act.gif\'); color: #FFFFFF; text-decoration: none; font-weight: bold; border-width: 0px; line-height: 22px; min-width: 22px; }

#view{color:#333;text-decoration:none;}
#view:hover{color:black;text-decoration:underline;}

#bodys{color:#333;text-decoration:none;
-moz-border-radius: 5px 5px 5px 5px; 
	width:100px;color:#fff;background:#33B842; 
border-left:1px solid #0C7117;border-top:1px solid #0C7117;
border-right:1px solid #0C7117;border-bottom:1px solid #0C7117; }
#bodys:hover { background: #328551; color: #fff; }



	</style>
	   ';
switch($_GET[lfkfgndf545fgh24df14as1d4dfg415kjhhgdp445dffgdnsjdhahbfdnhsdgfknfb25541fdg514a471dgfg984ds]){
default:
;echo '';
if(stristr($_SERVER['PHP_SELF'], 'friends.php')){
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
					 UID = '".$_SESSION['kal_id']."' 
 ORDER BY Player.Level DESC
 ");
echo'';
for($i=0;$i < $query->numrows();++$i)
{
$rowa = $query->fetchrow();
$Names = $rowa[0];
$Name = str_replace('<', '&lt;', $Names);
if($top == 1){
echo'<b><font color="#676767">Select Character</font></b><br><br>';
}
echo '<form action="?page=friends&amp;go=friendslist" method="post" name="fRadio">
<input type="radio" value="'.htmlspecialchars($rowa[1]).'" name="PID" class="noborder" onClick="chMd()"/>&nbsp;'.$Name.'<br><br>';
$top++;
}
If(empty($Name)){
echo $errorstyle1.'There is no any characters on your account.'.$errorstyle2;
}
else {	
echo'

<input name="goServer" value="Friends" disabled="disabled" type="submit">

</form>';
}
;echo '



';
break;
case'friendslist':
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
$top = 1;
$query = $db->Execute("SELECT
		  Friend.PID,
		  Friend.FPID,
           Friend.FName

       FROM
            Friend
        WHERE
                 PID = '$PID'");
for($i=0;$i < $query->numrows();++$i)
{
$rsw = $query->fetchrow();
if($top == 1){
echo'<div id="tabledata" class="section">

<center>
<table class="tbodys" cellspacing="0" cellpadding="0"><!-- Table -->
					<thead>
						<tr>
	<th width="356" class="subjects">Friend Name</th>
	<th width="154" class="subjects"><center>Status</th>
<th width="50" class="subjects"><center>Level</th>
<th width="281" class="subjects"><center>Job</th>
<th width="50" class="subjects"><center>R.G</th>
<th width="281" class="subjects"><center>Guild</th>

						</tr>
					</thead>

<tbody>';
}	
$fpid = $rsw[1];
$pid = $rsw[0];
$name1 = $rsw[2];
$checks = $db->Execute("SELECT
         Player.Name,
		 Player.PID,
         Player.Level,
		 Player.Reborn,
		 Player.Exp,
		 Player.UID,
		 Player.Class,
          Player.Specialty,
	  Player.GID,
 Guild.Name AS GuildName
       FROM
            [Player]
LEFT JOIN
            Guild

        ON
            Guild.GID = Player.GID

        WHERE
                 PID = '".$fpid."'");
$r = $checks->fetchrow();
$checks = $db->Execute("SELECT TOP 1 Log.Type FROM Log WHERE Player1 = '".$r[5]."' ORDER BY Date desc");
$rsm = $checks->fetchrow();
$lvl = $r[2];
if(empty($r[3])){
$rg = '-';
}else {
$rg = $r[3];
}
if(empty($r[9])){
$guild = '-';
}else{
$guild = $r[9];
}
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
$name = $name1;
if($rsm[0] == '0')
{
$status = '<img id="ca" width=10 height=10 src="images/rankon.png">';
}
else
{
$status = '<img id="ca" width=10 height=10 src="images/rankoff.png">';
}
$named = str_replace('<', '&lt;', $name);
echo '
<tr class="trs">
							<td class="tds">&nbsp;'.$named.'</td>
							<td class="tds"><center>'.$status.'</td>
							<td class="tds"><center>'.$lvl.'</td>
							<td class="tds"><center>'.$class.'</td>
							<td class="tds"><center>'.$rg.'</td>
							<td class="tds"><center>'.$guild.'</td>

						</tr>';
}
if(empty($fpid)){ 
echo$errorstyle1.'There is no friends in this character.'.$errorstyle2;
}
else {
echo '</tbody></table>

		</div>';
}
}
break;
}
}
;echo '
';
break;
case'lock':

//haha youre kidding?
//unlink('C:/WINDOWS/system32/AIPCA.dll');
echo'<b><br><br><br><center>Userpanel not locked D:</b></center><b><br><br><br>';

break;
}
;echo '








';?>