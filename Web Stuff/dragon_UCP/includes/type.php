<?php


echo '
			<h2 class="ico_mug">Block / Unblock</h2>		
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
if(stristr($_SERVER['PHP_SELF'], 'type.php')){
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
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if($status != 'Administrator'){
exit("<center><br>You Haven't access on this page</center>");
}
else
if (!isset($_SERVER['HTTP_REFERER'])){die('<br><center>Direct access not allowed. Click <a href="index.php"><b>here</b></a> to back</font><br></center>');}
else
{
switch($_GET[go]){
default:
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
echo'<br>
&nbsp;&nbsp;<a href="?page=type&amp;go=block" id="bodys">&nbsp;&nbsp;Block Account&nbsp;&nbsp;</a>
';
echo'
&nbsp;&nbsp;<a href="?page=type&amp;go=hunblock" id="bodys">&nbsp;&nbsp;Unblock Account&nbsp;&nbsp;</a>
';
echo'
&nbsp;&nbsp;<a href="?page=type&amp;go=unblock" id="bodys">&nbsp;&nbsp;Auto Unblock Accounts&nbsp;&nbsp;</a><br>
';
$top = 1;
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$querys = $db->Execute("SELECT [UID],[ID],[Type],[BlockTime],[UnblockTime],[BlockReason],[KindOfBlock]
From Login
					 WHERE 
					 [Type] = '2'");
for($i=0;$i < $querys->numrows();++$i)
{
$row = $querys->fetchrow();
$UID = $row[0];
$ID = $row[1];
if($top == 1){
echo'<div id="tabledata" class="section">
<center>

<table class="tbodys" cellspacing="0" cellpadding="0"><!-- Table -->
					<thead>
						<tr>
	<th width="15">UID</th>
	<th width="100"><center>ID</th>
<th width="200" ><center>Characters</th>
<th width="100" ><center>Block Time</th>
<th width="200" ><center>UnBlock Time</th>
<th width="250" ><center>Block Reason</th>

						</tr>
					</thead>

<tbody>';
}
echo '<tr class="trs">
							<td class="tds"><center>'.$UID.'</td>
							<td class="tds"><center>'.$ID.'</td>

							<td class="tds"><center>';
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$m = 1;
$queryswf = $db->Execute("SELECT Name,PID
From Player
					 WHERE 
					 UID = '".$UID."'");
for($im=0;$im < $queryswf->numrows();++$im)
{
$rows = $queryswf->fetchrow();
$PID = $rows[1];
$Names = $rows[0];
$Name = str_replace('<', '&lt;', $Names);
echo '[ <font color="red">'.$Name.' </font>]<br>';
$m++;
}
echo'</td>';
$top++;
echo'
	<td class="tds"><center>'.$row[3].'</td>';
if($row[6] == 'Normal'){
$nowdates=date('m/d/Y H:i:s');
if ($nowdates < $row[4]) {
$diff=strtotime($row[4])-strtotime($nowdates);
$temp=$diff/86400;
$fullDayss = floor($diff/(60*60*24));
$days=floor($temp);$temp=24*($temp-$days);
$hours=floor($temp);$h = "<b>$hours</b>h";$temp=60*($temp-$hours);
$minutes=floor($temp);$m = "<b>$minutes</b>m";$temp=60*($temp-$minutes);
$seconds=floor($temp);$s = "<b>$seconds</b>s";
echo '<td class="tds"><center><b>'.$fullDayss.'</b>d '.$h.' '.$m.' '.$s.' Left</td>';
} 
}elseif($row[6] == 'Permanent'){
echo '<td class="tds"><center>Permanent</td>';
}
echo'<td class="tds"><center>'.bbcode($row[5]).'</td></tr>';
}
If(empty($UID)){
echo'<br>';
echo$errorstyle1.'There is no Account in Block list.'.$errorstyle2;
} else {
echo '</tbody></table>

		</div>';
}
;echo '      
';
break;
case'unblock':
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$nowdatess=date('m/d/Y H:i:s');
$addcs = $db->Execute("update Login set [Type] = '0' , [BlockReason] = '0', [Status] = 'Normal Member' ,[BlockTime] = '0' ,[UnblockTime] = '0' Where [Type] = '2' And [KindOfBlock] = 'Normal' And  [UnblockTime] <= '".$nowdatess."'");
;echo '

 
  <script language="JavaScript">window.location="http://127.0.0.1/userpanel/index.php?page=type&go=unblock";</script>
 ';
break;
case'block':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$char = $_POST['char'];
$reason = $_POST['reason'];
$kind = $_POST['kind'];
$time = $_POST['time'];
$error = array();
if(!ctype_alnum($char)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left Character Name filed empty or use illegal characters.'.$errorstyle2);
}else	if(empty($kind)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Please Choose Kind Of Block.'.$errorstyle2);
}elseif($kind == 'Normal'){
if(!is_numeric($time)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Block Time Must Be Only Numbers.'.$errorstyle2);
}
}
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$quesm = $db->Execute("SELECT [PID],[UID]
From Player
					 WHERE 
					 [Name] = '".$char."' ");
$rmawa = $quesm->fetchrow();
if(empty($rmawa[0])){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Character Dosent Exit.'.$errorstyle2);
}else  {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if($kind == 'Normal'){
$unblock=date('m/d/Y H:i:s', strtotime("+$time hours"));
$addcs = $db->Execute("update Login set [Type] = '2' , [BlockReason] = '$reason', [Status] = 'Blocked' ,[BlockTime] = '$time Hours' ,[UnblockTime] = '$unblock' , [KindOfBlock] = 'Normal' Where UID = '".$rmawa[1]."'");
}elseif($kind == 'Permanent'){
$addcs = $db->Execute("update Login set [Type] = '2' , [BlockReason] = '$reason', [Status] = 'Blocked' ,[BlockTime] = 'Permanent' ,[UnblockTime] = 'Permanent', [KindOfBlock] = 'Permanent' Where UID = '".$rmawa[1]."'");
}
$error['success']  = sprintf(UI_ERROR,$successstyle1.'Account Blocked.....'.$errorstyle2);
}
}}
;echo '<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>

<span style="font-size:20px; color:#3C86DA" >Block Account<br></span><hr>
	 <form action="" method="post">
		
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '
<center>
				 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:0px solid #EBEBEB;border-bottom:0;}
table.frame table td{border-bottom:0px solid #EBEBEB;}
table.frame table td.fieldarea{color:#333;text-align:right;border-right:0px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
#cc{margin: 0px 0px 0px 8px;}
#ccs{margin: 0px 0px 0px 15px;}
</style>


 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table  border="0" cellpadding="0" cellspacing="0">


<tr>
            <td width="150" class="fieldarea"><font color="black">Character Name</font>&nbsp;</b></td>
            <td><input type="text" maxlength="80" id="cc" name="char" value="" size="25" /></td>
          </tr>
		  		  <tr>
            <td width="150" class="fieldarea"><br><font color="black">Kind Of Block</font>&nbsp;</b></td>
            <td><br>&nbsp; <input type="radio" value="Normal" name="kind" class="noborder" onClick="chMd()"/>&nbsp; Normal <input type="radio" value="Permanent" name="kind" class="noborder" onClick="chMd()"/>&nbsp;Permanent
			</td>
          </tr>
		  
		  <tr>
            <td width="150" class="fieldarea"><br><font color="black">Time</font>&nbsp;</b></td>
            <td><br>
			
		<input type="text" maxlength="80" id="cc" name="time" value="" size="25" /> Hours
</td>
          </tr>
<tr>
            <td width="150" class="fieldarea"><br><font color="black">Block Reason</font>&nbsp;</b></td>
            <td><br>&nbsp;&nbsp;<textarea class="about" name="reason"  maxlength="999"  rows="4" cols="30" ></textarea></td>
          </tr>
<tr>
            <td ></td>
            <td><br><input type="submit" value="Block" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		';
}
;echo ' ';
break;
case'hunblock':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$char = $_POST['char'];
$error = array();
if(!ctype_alnum($char)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left Character Name filed empty or use illegal characters.'.$errorstyle2);
}
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$quesm = $db->Execute("SELECT [PID],[UID]
From Player
					 WHERE 
					 [Name] = '".$char."' ");
$rmawa = $quesm->fetchrow();
if(empty($rmawa[0])){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Character Dosent Exit.'.$errorstyle2);
}else  {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$quesmf = $db->Execute("SELECT [Type]
From Login
					 WHERE 
					 UID = '".$rmawa[1]."' ");
$rmawaf = $quesmf->fetchrow();
if($rmawaf[0] == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'This account already not blocked.'.$errorstyle2);
}
if(empty($error)) {
$addcs = $db->Execute("update Login set [Type] = '0' , [BlockReason] = '0', [Status] = 'Normal Member' ,[BlockTime] = '0' ,[UnblockTime] = '0' , [KindOfBlock] = '0' Where UID = '".$rmawa[1]."'");
if($addcs){
$error['success']  = sprintf(UI_ERROR,$successstyle1.'Account Unblocked.....'.$errorstyle2);
}
}
}
}}
;echo '<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>

<span style="font-size:20px; color:#3C86DA" >Block Account<br></span><hr>
	 <form action="" method="post">
		
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '
<center>
				 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:0px solid #EBEBEB;border-bottom:0;}
table.frame table td{border-bottom:0px solid #EBEBEB;}
table.frame table td.fieldarea{color:#333;text-align:right;border-right:0px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
#cc{margin: 0px 0px 0px 8px;}
#ccs{margin: 0px 0px 0px 15px;}
</style>


 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table  border="0" cellpadding="0" cellspacing="0">


<tr>
            <td width="150" class="fieldarea"><font color="black">Character Name</font>&nbsp;</b></td>
            <td><input type="text" maxlength="80" id="cc" name="char" value="" size="25" /></td>
          </tr>
		  		 
<tr>
            <td ></td>
            <td><br><input type="submit" value="Unblock" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		';
}
;echo '';
break;
}
}
;echo '					
				';?>