<?php

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en" dir="ltr">
<head>
    <title>Tickets Panel | Admin</title>
    <link rel="shortcut icon" href="Ticket_images/favicon0.htm">
    <link rel="stylesheet" type="text/css" href="Ticket_images/global00.css">
    <link rel="stylesheet" type="text/css" href="Ticket_images/layout00.css">
    <link rel="stylesheet" type="text/css" href="Ticket_images/blue0000.css">
        <link rel="stylesheet" type="text/css" href="Ticket_images/rounded0.css">
        <link rel="stylesheet" type="text/css" href="Ticket_images/preview0.css">
</head>

	<style type="text/css" media="all">
.subject
{
	background: #fff url(\'Ticket_images/bg_box00.gif\') repeat-x top left;
	COLOR: #000000;
	FONT-SIZE: 11px;
	FONT-FAMILY: Verdana, Arial, Helvetica;
}


.row2
{
	BACKGROUND-COLOR: #EFEFEF;
	COLOR: #000000;
	FONT-SIZE: 11px;
	FONT-FAMILY: Verdana, Arial, Helvetica;


}



table { border-collapse: separate; border-spacing: 0; }
caption, th, td { text-align: left; font-weight: normal; }
table, td, th { vertical-align: middle; }
blockquote:before, blockquote:after, q:before, q:after { content: ""; }
blockquote, q { quotes: "" ""; }
a img { border: none; }

	
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
	


table {
	width: 100%;
	border: 1px solid #ccc;
margin: 5px 0px;

}


	tbody tr td {
		border-top: 1px solid #ccc;
		padding: 6px 5px;
		background: #FFFFFF;
	}







.pen { margin: -3px 0px; }
.sta { margin: 5px 0px; }
.stas { margin: -2px 0px; }
.posted { margin: -3px 0px; }

#view{color:#333;text-decoration:none;}
#view:hover{color:black;text-decoration:underline;}

#bodys{color:#333;text-decoration:none;
-moz-border-radius: 5px 5px 5px 5px; 
	width:100px;color:#fff;background:#33B842; 
border-left:1px solid #0C7117;border-top:1px solid #0C7117;
border-right:1px solid #0C7117;border-bottom:1px solid #0C7117; }
#bodys:hover { background: #328551; color: #fff;



	</style>


';
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if(stristr($_SERVER['PHP_SELF'], 'admin.php')){
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
else if($Support_Ticket != 'Admin'){
exit("<center><br>You Haven't access on this page</center>");
}
else
if (!isset($_SERVER['HTTP_REFERER'])){die('<br><center>Direct access not allowed. Click <a href="index.php"><b>here</b></a> to back</font><br></center>');}
else
{
switch($_GET[go]){
default:
;echo '<body id="pageDashboard" class="withoutSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li class="active"><a >Dashboard</a><li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 

<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">


                <span id="formEditor" class="mainForm clear" >
                    <fieldset class="clear" >

                        <legend ><span>Dashboard</span></legend>
                       <center><br><br><b>Welcome To Tickets Panel For Admins</b></cente>
                    </fieldset>

</div>



        
';
break;
case'rtickets':
echo'
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&go=ptickets">Pending Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=rtickets">Replied Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=ctickets">Closed Tickets</a></li> </li></ul></li>
<li class="active"><a>Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li></ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">
                    <fieldset class="clear">

                        <legend><span>Replied Tickets</span></legend><br>
';
$top = 1;
$querys = $db->Execute("SELECT Subject,Ticket_ID,Ticket,Status,Date_Sent,ID
From Tickets
					 WHERE 
					 Status = 'Replied' And  Ticket = 'Open' ORDER BY Tickets.Last_Post_Date DESC
 ");
$count= $querys->numrows();
for($i=0;$i < $querys->numrows();++$i)
{
$row = $querys->fetchrow();
$Subject = $row[0];
$Subjects = bbcode($row[0]);
$TicketID = $row[1];
if($top == 1){
echo'
<table id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>

<th width="5">Select</th>
<th class="colName left" width="356">Subject</th>
<th  width="154"><center>Status</th>
<th  width="151"><center>Ticket</th>
<th  width="281"><center>Date Sent</th>
<th  width="151"><center>Sent By</th></tr></thead>
<tbody>
';
}
if($row[2] == 'Open'){
$ticket = '<font color="blue">Open</font>';
}elseif($row[2] == 'Closed'){
$ticket = '<font color="red">Closed</font>';
}
if($row[3] == 'Pending'){
$Status = '<font color="#BE8E48"><span class="pen"><img class="pen" src="Ticket_images/ico_hourglass.jpg"></span> Pending</font>';
}elseif($row[3] == 'Replied'){
$Status = '<font color="green">Replied</font>';
}
echo '<form  action="" method="post" OnSubmit="return onDelete();">
<tr class="odd">
 <td><center><input type="checkbox" name="chkDel[]" value="'.$row[1].'"></td> 
<td class="colName left sortable"><a href="?Tickets_Panel=admin&amp;go=view&amp;id='.$TicketID.'" id="view"">'.$Subjects.'</a></td> 
<td ><center>'.$Status.'</td> 
<td ><center>'.$ticket.'</td> 
<td ><center>'.$row[4].'</td> 
<td ><center>'.$row[5].'</td> ';
$top++;
}
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
If(empty($_POST['chkDel'])){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("You Did Not Select Any Ticket.")
		window.location = "index.php?Tickets_Panel=admin&go=rtickets";
</SCRIPT>';
}
for($i=0;$i<count($_POST['chkDel']);$i++)
{
if($_POST['chkDel'][$i] != '')
{
$del = $db->Execute("DELETE FROM Tickets WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
$delde = $db->Execute("DELETE FROM Tickets_Replys WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
}
}
if(($del) And ($delde)){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=ptickets";</script>
';
}
}
If(empty($TicketID)){
echo'	<br><div id="msgError" class="message"> There is no replied tickets.</div>';
} else {
echo '  
 </td></tr></tbody></table>
<br>

<div id="actions">
 


<input type="submit" id="delete" name="btnDelete" class="button secondary" value="Delete Selected Tickets" onclick="return confirm(\'Are you sure want delete tickets that you selected.\');">
</form></div>
';
}
echo'</fieldset></span>';
;echo '
</div>
    
';
break;
case'ctickets':
echo'
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&go=ptickets">Pending Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=rtickets">Replied Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=cickets">Closed Tickets</a></li> </li></ul></li>
<li class="active"><a>Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li></ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">
                    <fieldset class="clear">

                        <legend><span>Closed Tickets</span></legend><br>
';
$top = 1;
$querys = $db->Execute("SELECT Subject,Ticket_ID,Ticket,Status,Date_Sent,ID
From Tickets
					 WHERE 
					   Ticket = 'Closed' ORDER BY Tickets.Last_Post_Date DESC
 ");
$count= $querys->numrows();
for($i=0;$i < $querys->numrows();++$i)
{
$row = $querys->fetchrow();
$Subject = $row[0];
$Subjects = bbcode($row[0]);
$TicketID = $row[1];
if($top == 1){
echo'
<table id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>

<th width="5">Select</th>
<th class="colName left" width="356">Subject</th>
<th  width="154"><center>Status</th>
<th  width="151"><center>Ticket</th>
<th  width="281"><center>Date Sent</th>
<th  width="151"><center>Sent By</th></tr></thead>
<tbody>
';
}
if($row[2] == 'Open'){
$ticket = '<font color="blue">Open</font>';
}elseif($row[2] == 'Closed'){
$ticket = '<font color="red">Closed</font>';
}
if($row[3] == 'Pending'){
$Status = '<font color="#BE8E48"><span class="pen"><img class="pen" src="Ticket_images/ico_hourglass.jpg"></span> Pending</font>';
}elseif($row[3] == 'Replied'){
$Status = '<font color="green">Replied</font>';
}
echo '<form  action="" method="post" OnSubmit="return onDelete();">
<tr class="odd">
 <td><center><input type="checkbox" name="chkDel[]" value="'.$row[1].'"></td> 
<td class="colName left sortable"><a href="?Tickets_Panel=admin&amp;go=view&amp;id='.$TicketID.'" id="view"">'.$Subjects.'</a></td> 
<td ><center>'.$Status.'</td> 
<td ><center>'.$ticket.'</td> 
<td ><center>'.$row[4].'</td> 
<td ><center>'.$row[5].'</td> ';
$top++;
}
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
If(empty($_POST['chkDel'])){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("You Did Not Select Any Ticket.")
		window.location = "index.php?Tickets_Panel=admin&go=ctickets";
</SCRIPT>';
}
for($i=0;$i<count($_POST['chkDel']);$i++)
{
if($_POST['chkDel'][$i] != '')
{
$del = $db->Execute("DELETE FROM Tickets WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
$delde = $db->Execute("DELETE FROM Tickets_Replys WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
}
}
if(($del) And ($delde)){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=ptickets";</script>
';
}
}
If(empty($TicketID)){
echo'	<br><div id="msgError" class="message"> There is no closed tickets.</div>';
} else {
echo '  
 </td></tr></tbody></table>
<br>

<div id="actions">
 


<input type="submit" id="delete" name="btnDelete" class="button secondary" value="Delete Selected Tickets" onclick="return confirm(\'Are you sure want delete tickets that you selected.\');">
</form></div>
';
}
echo'</fieldset></span>';
;echo '
</div>

';
break;
case'ptickets':
echo'
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&go=ptickets">Pending Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=rtickets">Replied Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=ctickets">Closed Tickets</a></li> </li></ul></li>
<li class="active"><a>Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li></ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">
                    <fieldset class="clear">

                        <legend><span>Pending Tickets</span></legend><br>
';
$top = 1;
$querys = $db->Execute("SELECT Subject,Ticket_ID,Ticket,Status,Date_Sent,ID
From Tickets
					 WHERE 
					 Status = 'Pending' And  Ticket = 'Open' ORDER BY Tickets.Last_Post_Date DESC
 ");
$count= $querys->numrows();
for($i=0;$i < $querys->numrows();++$i)
{
$row = $querys->fetchrow();
$Subject = $row[0];
$Subjects = bbcode($row[0]);
$TicketID = $row[1];
if($top == 1){
echo'
<table id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>

<th width="5">Select</th>
<th class="colName left" width="356">Subject</th>
<th  width="154"><center>Status</th>
<th  width="151"><center>Ticket</th>
<th  width="281"><center>Date Sent</th>
<th  width="151"><center>Sent By</th></tr></thead>
<tbody>
';
}
if($row[2] == 'Open'){
$ticket = '<font color="blue">Open</font>';
}elseif($row[2] == 'Closed'){
$ticket = '<font color="red">Closed</font>';
}
if($row[3] == 'Pending'){
$Status = '<font color="#BE8E48"><span class="pen"><img class="pen" src="Ticket_images/ico_hourglass.jpg"></span> Pending</font>';
}elseif($row[3] == 'Replied'){
$Status = '<font color="green">Replied</font>';
}
echo '<form  action="" method="post" OnSubmit="return onDelete();">
<tr class="odd">
 <td><center><input type="checkbox" name="chkDel[]" value="'.$row[1].'"></td> 
<td class="colName left sortable"><a href="?Tickets_Panel=admin&amp;go=view&amp;id='.$TicketID.'" id="view"">'.$Subjects.'</a></td> 
<td ><center>'.$Status.'</td> 
<td ><center>'.$ticket.'</td> 
<td ><center>'.$row[4].'</td> 
<td ><center>'.$row[5].'</td> ';
$top++;
}
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
If(empty($_POST['chkDel'])){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("You Did Not Select Any Ticket.")
		window.location = "index.php?Tickets_Panel=admin&go=ptickets";
</SCRIPT>';
}
for($i=0;$i<count($_POST['chkDel']);$i++)
{
if($_POST['chkDel'][$i] != '')
{
$del = $db->Execute("DELETE FROM Tickets WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
$delde = $db->Execute("DELETE FROM Tickets_Replys WHERE Ticket_ID = '".$_POST['chkDel'][$i]."'");
}
}
if(($del) And ($delde)){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=ptickets";</script>
';
}
}
If(empty($TicketID)){
echo'	<br><div id="msgError" class="message"> There is no pending tickets.</div>';
} else {
echo '  
 </td></tr></tbody></table>
<br>

<div id="actions">
 


<input type="submit" id="delete" name="btnDelete" class="button secondary" value="Delete Selected Tickets" onclick="return confirm(\'Are you sure want delete tickets that you selected.\');">
</form></div>
';
}
echo'</fieldset></span>';
;echo '
</div>


';
break;
case'view':
$TicketID = $_GET['id'];
if(!is_numeric($TicketID)) {
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("Please select your ticket.")
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
echo'
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&go=ptickets">Pending Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=rtickets">Replied Tickets</a></li> </li>
<li><a href="?Tickets_Panel=admin&go=ctickets">Closed Tickets</a></li> </li></ul></li>
<li class="active"><a>Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li></ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">

';
$view = $db->Execute("SELECT Ticket_ID,Ticket,Status,Subject,IP,Last_Post_Date,Date_Sent,Picture1,Picture2,Picture3,Message,ID
				FROM
					Tickets
				WHERE	
Ticket_ID = '$TicketID'");
if(isset($_POST['Submit'])) {
$selects = $_POST['selects'];
$up = $db->Execute("Update Tickets Set Ticket = '$selects' Where Ticket_ID = '$TicketID'");
if($up){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=view&id='.$TicketID.'";</script>';
}
}
echo'<form  action="" method="post">';
for($i=0;$i < $view->numrows();++$i)
{
$r = $view->fetchrow();
$Ticket = $r[0];
if($r[1] == 'Open'){
$tickets = ' <select name="selects" class="sta">
		<option value="Open">Open</option>
		<option value="Closed">Close</option>

	</select> <span class="sta"><font color="blue">&nbsp;&nbsp;&nbsp; - Open</font></span>
';
}elseif($r[1] == 'Closed'){
$tickets = '<select name="selects" class="sta">
		<option value="Closed">Closed</option>
		<option value="Open">Open</option>

	</select><font color="red">&nbsp;&nbsp;&nbsp; - Closed</font>';
}
if($r[2] == 'Pending'){
$Status = '<font color="#BE8E48"><span class="pen"><img class="pen" src="Ticket_images/ico_hourglass.jpg"></span> Pending</font>';
}elseif($r[2] == 'Replied'){
$Status = '<font color="green">Replied</font>';
}
echo '                     <fieldset class="clear">

 <legend><span >'.bbcode($r[3]).'</span></legend>



		';
echo '	<table border="0" cellpadding="4" cellspacing="1" width="100%">
	  <tbody>

            <tr class="odd">
		<td class="row2" align="left" valign="top" width="100">Ticket ID : </td>
		<td align="left" valign="top" width="180">'.$Ticket.'</td>
		<td class="row2" align="left" valign="top" width="100">IP Address : </td>
		<td align="left" valign="top" style="width: 80">'.$r[4].'</td>
	  </tr>
	  <tr class="odd">
		<td class="row2" align="left" >Ticket : </td>
		<td align="left" >'.$tickets.'</font></td>
		<td class="row2" >Date Sent : </td>
		<td align="left" >'.$r[6].'</td>
	  </tr>
	  	<tr class="odd">

		<td class="row2" >Status : </td>
		<td style"align;left >'.$Status.'</td>
		<td class="row2" >Last Post Date : </td>
		<td align="left">'.$r[5].'</td>
		</tr>


	 	  </tbody></table>
<div id="actions">
<input type="submit"  name="Submit" class="button secondary" value="Submit" >
</div>
  <br>
		';
if(!empty($r[7])){ 
$pica1s = '<a href="'.$r[7].'" target="_blank" ><img border="0" width=60 height=60 src="'.$r[7].'" /></a>&nbsp;&nbsp;';
} else { $pica1s = '&nbsp;';}
if(!empty($r[8])){ 
$pica2s =  '<a href="'.$r[8].'" target="_blank" ><img border="0" width=60 height=60 src="'.$r[8].'" /></a>&nbsp;&nbsp;';
} else { $pica2s = '&nbsp;';}
if(!empty($r[9])){ 
$pica3s =  '<a href="'.$r[9].'" target="_blank" ><img border="0" width=60 height=60 src="'.$r[9].'" /></a>';
} else { $pica3s = '&nbsp;';}
if((empty($r[7])) And (empty($r[8])) And (empty($r[9]))){
}else{
$pictureshow = '
<tr><td colspan="2" align="left" valign="top">

<span class="mediumtext">'.$pica1s.''.$pica2s.''.$pica3s.'</span></td></tr>';
}
echo '



<table class="tbody" border="0" cellpadding="3" cellspacing="1" width="100%" style="vertical-align: middle">
<tbody>

<tr>
<th align="left" class="subject"><img width=16 height=16 class="posted" src="Ticket_images/ico_page.png"> Posted By: <b>'.$r[11].'</b></th>
<th style="text-align:right" class="subject"><img class="posted" src="Ticket_images/icon_emailopen.gif"> Posted On: '.$r[6].'</th></tr>




<tr><td colspan="2" align="left" valign="top">

<span class="mediumtext">'.bbcode($r[10]).'</span></td></tr>
'.$pictureshow.'

</tbody></table><br>


';
};
if(empty($Ticket)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You cant view this ticket.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
}
echo'</fieldset></span>';
$replys = $db->Execute("SELECT Reply,Posted_By,Posted_On
				FROM
					Tickets_Replys
				WHERE	
Ticket_ID = '$TicketID'  Order by Posted_On
 ");
for($i=0;$i < $replys->numrows();++$i)
{
$rs = $replys->fetchrow();
echo'<table class="tbody" border="0" cellpadding="3" cellspacing="1" width="100%" style="vertical-align: middle">
<tbody>

<tr>
<th align="left" class="subject"><img width=16 height=16 class="posted" src="Ticket_images/ico_page.png"> Posted By: <b>'.$rs[1].'</b></th>
<th style="text-align:right" class="subject"><img class="posted" src="Ticket_images/icon_emailopen.gif"> Posted On: '.$rs[2].'</th></tr>


<tr><td colspan="2" align="left" valign="top">

<span class="mediumtext">'.bbcode($rs[0]).'</span></td></tr>

</tbody></table>';
}
define('UI_ERROR','%s');
if(isset($_POST['submits'])) {
$error = array();
if (empty($_POST['message'])){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont Left Message Empty.</div>');
} else
if (strlen($_POST['message']) == 0){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont Left Message Empty.</div>');
} else
if (strlen($_POST['message']) < 5){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">5 Letter Minimum In Message.</div>');
}  else
if (strlen($_POST['message']) > 999){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">999 Letter Maximum In Message.</div>');
} 
if(empty($error)) {
$checks	=    $db->Execute("SELECT Username
				FROM
					Login
				WHERE	
UID = '".$_SESSION['kal_id']."'");
$r = $checks->fetchrow();
$username = $r[0];
if(empty($username)){
$tag = 'Admin';
}else{
$tag = ''.$username.'';
}
$Date_Replyed = date( 'F. dS. Y - H:i' );
$ReplyID = RandomNubmers(12);
$replyed = $db->Execute('INSERT INTO Tickets_Replys (Ticket_ID,Reply_ID,ID,UID,Posted_On,Posted_By,Reply)
VALUES (?,?,?,?,?,?,?)', array($TicketID,$ReplyID,$_SESSION['kal_username'],$_SESSION['kal_id'],$Date_Replyed,$tag,$_POST['message']));
$ups = $db->Execute("Update Tickets Set [Read] = 'Not' , Last_Post_Date = '$Date_Replyed' , Status = 'Replied' Where Ticket_ID = '$TicketID'");
if(($replyed) And ($ups)){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=view&id='.$TicketID.'";</script>';
}
}
}
echo'<form  action="" method="post"><br><br><table id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>
'.$error['error'].'
<th class="colName left" width="356">Reply</th></tr></thead>
<tbody>
<tr class="odd">
<td ><textarea name="message"  maxlength="999"  rows="8" cols="106" style="width:352;height:107;"></textarea>
</td>

</tr>
<tr><td>
<div id="actions">
<input type="submit" name="submits"  class="button secondary" value="Send Reply" ><br>
</div>
</tr></td>
</tbody>
</table>
</form>

';
;echo '</div>

     
';
break;
case'dis':
;echo '
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=disacc">Disable Tickets In Account</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=dislist">List of Accounts That Disabled From Tickets</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li class="active"><a>Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">

                <span id="formEditor" name="formEditor" class="mainForm clear" >
                    <fieldset class="clear">

                        <legend><span>Disable Tickets From Accounts</span></legend>
<center><br><br>Here You can disable ticket system from any account.</center>

                    </fieldset></span>

</div>

   
     
';
break;
case'disacc':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$mesee = preg_replace ('[^A-Za-z0-9]', '', $_POST['message']);
$idk=array('"', "'", ';', '^' , '*' , '<>', '><' , '<?php' , '?>' , '`');
$mesee = str_replace($idk, '', $mesee);
$account = $_POST['account'];
$error = array();
if(!ctype_alnum($account)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Illegal characters in account id.</div>');
}else	
if($_POST['message'] != $mesee){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Use normal characters in reason field.</div>');
}  else
if (strlen($mesee) > 999){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">999 Letter Maximum In reason.</div>');
} else
if(empty($error)) {
$check	=    $db->Execute("SELECT ID,UID
				FROM
					Login
				WHERE	
ID = '".$account."'");
$r = $check->fetchrow();
$accounts = $r[0];
$uids = $r[1];
$checks	=    $db->Execute("SELECT ID
				FROM
					Disable_Tickets_From_Accounts
				WHERE	
ID = '".$account."'");
$rs = $checks->fetchrow();
$acc = $rs[0];
if(empty($accounts)){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Account ID does not exist.</div>');
}else
if(!empty($acc)){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Tickets already disabled  in this account.</div>');
}else
if(empty($error)) {
if(empty($mesee)){
$reason = '0';
}else {
$reason = ''.$mesee.'';
}
$Date_dis = date( 'F. dS. Y - H:i' );
$add = $db->Execute("INSERT INTO Disable_Tickets_From_Accounts (ID,UID,Reason,Disabled_By,Disabled_From,Disabled_On) 
VALUES ('".$account."','".$uids."','".$reason."','".$_SESSION['kal_username']."','Admin','".$Date_dis."')");
if($add){
$error['success'] = sprintf(UI_ERROR,'<div id="msgConfirm" class="message">Tickets has been disabled successfully in this account ('.$account.').</div>');
}
}
}}
;echo '
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=disacc">Disable Tickets In Account</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=dislist">List of Accounts That Disabled From Tickets</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li class="active"><a>Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">

<form  action="" method="post" >
                <span id="formEditor" name="formEditor" class="mainForm clear" >

                    <fieldset class="clear">

                        <legend><span>Disable Tickets In Account</span></legend>
<br>
';echo @$error['error'];;echo '		';echo @$error['success'];;echo '';
if(!$error['success']){
;echo '                        <div class="field clear">
                            <label for="txtName">Account ID : </label>
                            <input id="txtName" name="account" type="text" value="">
                            <a class="hint" href="#">
                                &nbsp;</a></div>
                        <div class="field clear">
                            <label for="areaText">Reason :  </label>
You can left reason empty<br>
                            <textarea  name="message" rows="4" cols="40"></textarea>
                            </div>

                    </fieldset></span>


<input type="submit" class="button primary" value="Disable Now"></center>
</form>

';
}
;echo '			
</div>

     
';
break;
case'dislist':
echo'
<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=disacc">Disable Tickets In Account</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=dislist">List of Accounts That Disabled From Tickets</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li class="active"><a>Disable Tickets From Accounts</a></li>
 <li><a href="index.php?Tickets_Panel=admin&amp;go=panel">Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>



<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">
                    <fieldset class="clear">

                        <legend><span>List of Accounts That Disabled From Tickets</span></legend><br>
';
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$UID = $_POST['UID'];
If(empty($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=dislist";
</SCRIPT>';
}
else
If(!is_numeric($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
}
else {
$del = $db->Execute("DELETE FROM Disable_Tickets_From_Accounts WHERE UID = '".$UID."'");
if($del){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=dislist";</script>
';
}
}}
$top = 1;
$querys = $db->Execute("SELECT ID,Reason,UID,Disabled_By,Disabled_From
From Disable_Tickets_From_Accounts where UID != '0' order by Disabled_On Desc");
for($i=0;$i < $querys->numrows();++$i)
{
$row = $querys->fetchrow();
$ID = $row[0];
$Reason = bbcode($row[1]);
$UID = $row[2];
if($top == 1){
echo'
<table  id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th width="10">UID</th>
<th width="120"><center>Account ID</th>
<th class="colName left" width="386">Reason</th>
<th  width="120"><center>Disabled By</th>
<th  width="20">&nbsp;</th></tr></thead>
<tbody>
';
}
if(empty($Reason)){
$reasons = 'No Reason';
}else {
$reasons = ''.$Reason.'';
}
echo '<form  action="" method="post" >
<tr class="odd">
 <td><center>'.$row[2].'</td> 
<td ><center>'.$row[0].'</a></td> 
<td class="colName left sortable">'.$reasons.'<center></td> 
<td ><center>'.$row[3].' - ('.$row[4].')</td> 
<td ><center>
<form method="post" action="">
<input type="hidden" name="UID" value="'.htmlspecialchars($row[2]).'">
<input type="submit" class="button button secondary" value="Delete" onclick="return confirm(\'Are you sure want delete this account from list.\');">
</form></td>';
$top++;
}
If(empty($UID)){
echo'	<br><div id="msgError" class="message"> There is no accounts that tickets disabled from it.</div>';
} 
echo'</tbody></table>';
;echo '
</div>
   

';
break;
case'panel':
;echo '<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=addpan">Add New Admin Or Staff</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=panlist">Staffs , Admins List</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li class="active"><a>Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">

                <span id="formEditor" name="formEditor" class="mainForm clear" >
                    <fieldset class="clear">

                        <legend><span>Tickets Panel Staff , Admins</span></legend>
<center><br><br>Here you can add admins or staffs for tickets.</center>


                    </fieldset></span>

</div>


';
break;
case'addpan':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$account = $_POST['account'];
$username = $_POST['username'];
$kind = $_POST['kind'];
$error = array();
if(empty($account)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont left account id empty.</div>');
}else  
if(!ctype_alnum($account)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Illegal characters in account id.</div>');
}else  
if(empty($username)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont left username empty.</div>');
}else  
if(!ctype_alnum($username)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont use illegal characters in username.</div>');
}else
if(empty($kind)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">please select rank of account.</div>');
}else  
if(!ctype_alnum($kind)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">you cant choose this choice.</div>');
}else
if(empty($error)){
$check	=    $db->Execute("SELECT ID
				FROM
					Login
				WHERE	
ID = '".$account."'");
$r = $check->fetchrow();
$accounts = $r[0];
if(empty($accounts)){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Account ID does not exist.</div>');
} else
if($accounts == $_SESSION['kal_username']){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">You already using this Account now so you cant add it.</div>');
} else 
if(empty($error)){
$add = $db->Execute("Update Login Set Tickets_Panel = '".$kind."' , Username = '".$username."' Where ID = '".$account."'");
if($add){
$error['success'] = sprintf(UI_ERROR,'<div id="msgConfirm" class="message">Account has been added successfully.</div>');
}
}
}
}
;echo '<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=addpan">Add New Admin Or Staff</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=panlist">Staffs , Admins List</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li class="active"><a>Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">

                <span id="formEditor" name="formEditor" class="mainForm clear" >
                    <fieldset class="clear">

                        <legend><span>Add New Admin Or Staff</span></legend>
<form  action="" method="post" >
<br>
';echo @$error['error'];;echo '		';echo @$error['success'];;echo '';
if(!$error['success']){
;echo '

                        <div class="field clear">
                            <label for="txtName">Account ID : </label>
                            <input id="txtName" name="account" type="text" value="">
</div>
                        <div class="field clear">
                            <label for="areaText">Username :  </label>Thats Appear in replys<br>
                            <input id="txtName" name="username" type="text" value=""> 

                            </div>
                        <div class="field clear">
                            <label for="areaText">&nbsp;</label>
                            <select name="kind" class="sta">
		<option value="0">Please Select Rank</option>
		<option value="Admin">Admin</option>
		<option value="Staff">Staff</option>

	</select> 

                            </div>

 
                        <div class="field clear">
<input type="submit" class="button primary" value="Add"></center>
</form>
     </div>
';
}
;echo '
                   </fieldset></span>


</div>


';
break;
case'panlist':
echo'

<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=addpan">Add New Admin Or Staff</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=panlist">Staffs , Admins List</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li class="active"><a>Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>'.$_SESSION['kal_username'].'</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>



<div id="content" class="clear">

            <div id="main" class="clear">
 <span id="formEditor"  class="mainForm clear">
                    <fieldset class="clear">

                        <legend><span>Staffs , Admins List</span></legend><br>
';
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$UID = $_POST['UID'];
if($UID == $_SESSION['kal_id']){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("You cant delete this account from list because your using this account in tickets panel now.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
exit();
} else
If(empty($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
exit();
} else
If(!is_numeric($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
exit();
}
else {
$del = $db->Execute("Update Login Set Tickets_Panel = '0' , Username = '0' WHERE UID = '".$UID."'");
if($del){
echo '<script language="JavaScript">window.location="index.php?Tickets_Panel=admin&go=panlist";</script>
';
}
}}
$top = 1;
$querysa = $db->Execute("SELECT ID,Username,Tickets_Panel,UID
From Login where Tickets_Panel = 'Admin' Or Tickets_Panel = 'Staff'");
for($i=0;$i < $querysa->numrows();++$i)
{
$row = $querysa->fetchrow();
$ID = $row[0];
$Username = $row[1];
$kind = $row[2];
$UID = $row[3];
if($top == 1){
echo'
<table  id="tableItems" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th width="10">UID</th>
<th width="150"><center>Account ID</th>
<th  width="150"><center>Username</th>
<th  width="120"><center>Rank</th>
<th  width="20">&nbsp;</th>
<th  width="20">&nbsp;</th></tr></thead>
<tbody>
';
}
if(empty($Username)){
$un = '-';
}else {
$un = ''.$Username.'';
}
echo '<form  action="index.php?Tickets_Panel=admin&go=panedit" method="post" >
<tr class="odd">
 <td><center>'.$row[3].'</td> 
<td ><center>'.$row[0].'</a></td> 
<td ><center>'.$un.'</td> 
<td ><center>'.$row[2].'</td> 
<td ><center>
<form method="post" action="">
<input type="hidden" name="UID" value="'.htmlspecialchars($row[3]).'">
<input type="submit" class="button button secondary" value="Edit" >
</form></td>
<td ><center>
<form method="post" action="">
<input type="hidden" name="UID" value="'.htmlspecialchars($row[3]).'">
<input type="submit" class="button button secondary" value="Delete" onclick="return confirm(\'Are you sure want delete this account from list.\');">
</form></td>
';
$top++;
}
If(empty($UID)){
echo'	<br><div id="msgError" class="message"> There is no admins or staffs in the list.</div>';
} 
echo'</tbody></table>';
;echo '
</div>


';
break;
case'panedit':
$UID = $_POST['UID'];
If(empty($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
} else
If(!is_numeric($UID)){
echo'<SCRIPT LANGUAGE="JavaScript">
		alert("Please Select The Correct Account.")
		window.location = "index.php?Tickets_Panel=admin&go=panlist";
</SCRIPT>';
}
else {
$check	=    $db->Execute("SELECT ID,Tickets_Panel,Username
				FROM
					Login
				WHERE	
UID = '".$UID."' And Tickets_Panel != '0'");
for($i=0;$i < $check->numrows();++$i)
{
$r = $check->fetchrow();
$accounts = $r[0];
$rn = $r[1];
$username = $r[2];
if($UID == $_SESSION['kal_id']){
$rank = 'You cant edit rank of this account because you are using it now';
}else {
if($r[1] == 'Admin'){
$rank = ' <select name="kind" class="stas">
		<option value="Admin">Admin</option>
		<option value="Staff">Staff</option>

	</select> <font color="blue">&nbsp;&nbsp;&nbsp; - Admin</font>
';
}elseif($r[1] == 'Staff'){
$rank = '<select name="kind" class="stas">
		<option value="Staff">Staff</option>
		<option value="Admin">Admin</option>

	</select><font color="blue">&nbsp;&nbsp;&nbsp; - Staff</font>';
}
}
}
define('UI_ERROR','%s');
if(isset($_POST['submits'])) {
$username = $_POST['username'];
$kind = $_POST['kind'];
$error = array();
if(empty($username)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont left username empty.</div>');
}else  
if(!ctype_alnum($username)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Dont use illegal characters in username.</div>');
}else
if (strlen($username) > 15){
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">Username should be no more than 15 characters.</div>');
} else
if($UID != $_SESSION['kal_id']){
if(empty($kind)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">please select rank of account.</div>');
}else  
if(!ctype_alnum($kind)) {
$error['error'] = sprintf(UI_ERROR,'<div id="msgError" class="message">you cant choose this choice.</div>');
}
} 
if(empty($error)){
if($UID == $_SESSION['kal_id']){
$add = $db->Execute("Update Login Set Tickets_Panel = '".$rn."' , Username = '".$username."' Where UID = '".$UID."'");
}else{
$add = $db->Execute("Update Login Set Tickets_Panel = '".$kind."' , Username = '".$username."' Where UID = '".$UID."'");
}
if($add){
$error['success'] = sprintf(UI_ERROR,'<div id="msgConfirm" class="message">Account has been edited successfully.</div>');
}
}
}
}
;echo '<body id="pageDashboard" class="withSubnav">
<div id="wrapper"><div id="top"><div id="title" class="clear"> 
	<span style="background-position: 0% 0%"><font color="#F5F5F5">Tickets Panel</font></span><font color="#F5F5F5">
	</font> <span> <font color="#F5F5F5">| Admin</font></span></div>

<div id="menu" class="clear"><ul> 
<li ><a href="?Tickets_Panel=admin">Dashboard</a><ul> 
<li><a href="?Tickets_Panel=admin&amp;go=addpan">Add New Admin Or Staff</a></li> </li>
<li><a href="?Tickets_Panel=admin&amp;go=panlist">Staffs , Admins List</a></li> </li></ul></li>
<li ><a href="?Tickets_Panel=admin&amp;go=ptickets">Tickets</a></li> 
<li><a href="index.php?Tickets_Panel=admin&amp;go=dis">Disable Tickets From Accounts</a></li>
 <li class="active"><a>Tickets Panel Staff , Admins</a></li> </ul></div>
<div id="toolbar" class="clear"><p id="user">Logged in as,  <b>';echo ''.$_SESSION['kal_username'].'';;echo '</b></p>
<div id="buttons"> <a href="index.php" class="button tool">Back To Home</a> <a href="index.php?Tickets_Panel=admin&amp;go=logout" class="button tool">Log out</a></div></div></div>


<div id="content" class="clear">

            <div id="main" class="clear">

                <span id="formEditor" name="formEditor" class="mainForm clear" >
                    <fieldset class="clear">

                        <legend><span>Add New Admin Or Staff</span></legend>
<form  action="" method="post" >
<br>
';echo @$error['error'];;echo '		';echo @$error['success'];;echo '';
if(!$error['success']){
;echo '
                        <div class="field clear">
                            <label for="txtName">UID : </label>
                             <label for="txtName">';echo ''.$UID.'';;echo '</label>
</div>
                        <div class="field clear">
                            <label for="txtName">Account ID : </label>
                            <label for="txtName">';echo ''.$accounts.'';;echo '</label>
</div>
                        <div class="field clear">
                            <label for="areaText">Username :  </label>Thats Appear in replys<br>
                            <input id="txtName" name="username" type="text" value="';echo ''.$username.'';;echo '"> 

                            </div>
                        <div class="field clear">
                            <label for="areaText">&nbsp;</label>
                            ';echo ''.$rank.'';;echo '                            </div>

 
                        <div class="field clear">
<input type="hidden" name="UID" value="';echo''.htmlspecialchars($UID).'';;echo '">
<input type="submit" name="submits" class="button primary" value="Edit"></center>
</form>
     </div>
';
}
;echo '
                   </fieldset></span>


</div>


';
break;
case'logout':
session_destroy();
echo '<script language="JavaScript">window.location="index.php";</script>';
;echo '
 ';
break;
}
$cc = $db->Execute('SELECT Ticket_ID From Tickets');
$count = $cc->numrows();
$admins = $db->Execute("SELECT Tickets_Panel From Login Where Tickets_Panel = 'Admin'");
$countadmins = $admins->numrows();
$staffs = $db->Execute("SELECT Tickets_Panel From Login Where Tickets_Panel = 'Staff'");
$countstaff = $staffs->numrows();
$replys = $db->Execute('SELECT Reply_ID From Tickets_Replys');
$countreplys = $replys->numrows();
;echo '


	<div id="sidebar" style="width: 220px; height: 169px">
<div id="summary" class="sidebox clear"><h1>Some details</h1>
<div class="boxContent clear"><dl class="clear">
<dt>Total Tickets:</dt><dd>';echo $count;;echo '</dd>
<dt>Total Replies:</dt><dd>';echo $countreplys;;echo '</dd>
<dt>Total Staffs:</dt><dd>';echo $countstaff;;echo '</dd>
<dt>Total Admins:</dt><dd>';echo $countadmins;;echo '</dd>

</div></div></div></div><div id="push">&nbsp;</div></div>
<div id="footer"><div id="wrapFooter">
<center><br>Copyright &copy; 2010-2011 DragoN-PHP. All rights reserved.<br>Coded by <a href="mailto:the_dragon20072008@hotmail.com">TheDragoN</a></center></div></div></body></html>


';
}
;echo '

';?>