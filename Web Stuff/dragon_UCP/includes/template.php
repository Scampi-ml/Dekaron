<?php
if(stristr($_SERVER['PHP_SELF'], 'template.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
else
if ($_SESSION['kal_login'] != 'yes'){
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You Must Login First.")
		window.location = "index.php";
</SCRIPT>';
exit();
} else {
include('status.php');
if($Support_Ticket == 'Admin'){
$supports = '<li><a href="?Tickets_Panel=admin"><img src="images/ico_book.png" /><span>Tickets Panel</span></a></li>';
$Tickets_Panel = $_GET['Tickets_Panel'];
if ($Tickets_Panel == 'admin'){ 
include('../includes/admin.php');exit();
}
}
if($Support_Ticket == 'Staff'){
$Tickets_Panel = $_GET['Tickets_Panel'];
$supports = '<li><a href="?Tickets_Panel=staff"><img src="images/ico_book.png" /><span>Tickets Panel</span></a></li>';
if ($Tickets_Panel == 'staff'){ 
include('../includes/staff.php');exit();
}
}
;echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>';echo $Server_Name;;echo ' User Panel</title>
	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
	
    <link rel="stylesheet" type="text/css" media="all" href="images/style02.css" />


	<link rel="stylesheet" type="text/css" href="images/superfish.css" media="screen">



</head>
 <style type="text/css">
 .style155 {
	text-decoration: underline;
}
.style35 {
	font-family: "Outer Sider BRK";
	font-size: 25px;
}
.style55 {
	font-family: GosmickSansBoldOblique;
	font-size: 15px;
}

.replied{

margin: -3px 0px 0px -170px;
}
.infoos{

margin:-18px 0px 0px 0px;
}
.sta{

margin:2px 0px 0px 0px;
}
.afas{

margin:-2px 0px 0px 0px;
}
</style>
<body>
<div class="container" id="container">
    <div  id="header">
    	<div id="profile_info">
			
';
if($read == 'Not') {
$reads = '<img src="images/replied.png" class="replied"  />';
$wa = '<p class="infoos">';
}
else {
$reads = '';
$wa = '<p>';
}
if (empty($donator)) {
echo ' <img src="images/avatar2.png" id="avatar" alt="avatar" />'.$reads;
}
else	if($donator == Off) {
echo ' <img src="images/avatar2.png" id="avatar" alt="avatar" />'.$reads;
}
else if($donator == On) {
echo ' <img src="images/avatar.png" id="avatar" alt="avatar" />'.$reads;
}	
;echo '			
			';echo $wa;;echo 'Welcome back : <strong>	';echo ''.$_SESSION['kal_username'].'';;echo ' 
			
	 </strong></a></p>
			<p class="sta">Status : <strong>	
';
if (empty($status)) {
echo ' <font color="#E7E7E6">There isn`t status</font>';
}else
if(($status == 'Normal Member') && ($types == '0')){
echo '<strong>Normal Member</strong>';
}else if(($status == 'Blocked') || ($types == '2')){
echo '<font color="#FC2525">Blocked</font>';
}else if($status == 'Not Activated'){
echo '<font color="#E05FB7">Not Activated</font>';
}else if($status == 'Inactivate'){
echo '<font color="#21EDFF">Inactivate</font>';
}else if($status == 'Administrator'){
echo '<font color="#33CB3A">Administrator</font>';
}	
;echo ' 
			
	 </strong></p>
			<p class="last_login">Last login : ';echo ''.$_SESSION['kal_lastlogin'].'';;echo ' </p>
		</div>
		<div id="logo">	<img src="images/logo.jpg"></div>
	
    </div><!-- end header -->
	    <div id="content" >
	    <div id="top_menu" class="clearfix">
	    	<ul class="sf-menu"> <!-- DROPDOWN MENU -->
			
			<li>
				<a href="index.php">Dashboard</a>
			</li>
			
					<li>
				<a href="?page=unstuck">Unstuck</a>
			</li>
								<li>
				<a href="?page=reborn">Reborn System</a>
			</li>
				<li>
				<a href="?page=rage">Rage Reset</a>
			</li>
						<li>
				<a href="?page=guildtime">Guild Time Reset</a>
			</li>


			<li>
				<a href="?page=accinfo">Account Information</a>
			</li>
			<li>
				<a href="?page=trade">Trade Characters</a>
			</li>
			<li>
				<a href="?page=ticket">Support Ticket</a>
			</li>
					


						
			<li><a href="?logout">Logout</a></li>
			
			
			</li>
			
		</ul>
			
	    </div>
		
		<div id="content_main" class="clearfix">
			<div id="main_panel_container" class="left">
			<div id="dashboard">
				

';
$site = $_GET['page'];
if (empty($site)){
include('../includes/news.php');
} else 
if ($site == 'info'){
include('../includes/info.php');
}
else if ($site == 'info2'){
include('../includes/info2.php');
}
else if ($site == 'unstuck'){
include('../includes/unstuck.php');
} else if ($site == 'rage'){
include('../includes/rage.php');
}else if ($site == 'guildtime'){
include('../includes/guildtime.php');
}else if ($site == 'accinfo'){
include('../includes/accinfo.php');
}else if ($site == 'ticket'){
include('../includes/ticket.php');
}else if ($site == 'chat'){
include('../includes/chat.php');
}else if ($site == 'trade'){
include('../includes/trade.php');
}else if ($site == 'lostsn'){
include('../includes/lostsn.php');
}else if ($site == 'accstatus'){
include('../includes/accstatus.php');
}else if ($site == 'friends'){
include('../includes/friends.php');
}else if ($site == 'reborn'){
include('../includes/reborn.php');
}else if ($site == 'type'){
include('../includes/type.php');
}
;echo '			
			</div><!-- end #dashboard -->
			
			
			<div id="shortcuts" class="clearfix">

				<ul>
					
					
								

  	';
if($type == 0){
echo '<li class="first_li"><a href="?page=accstatus"><img src="images/activate.png" alt="Deactivate" /><span>Deactivate</span></a></li>';
}else if($type == 2){
echo '';
}else if($type == 1){
echo '<li class="first_li"><a href="?page=accstatus"><img src="images/deactivate.png" alt="Activate" /><span>Activate</span></a></li>';
}else if($type == 5){
echo '<li class="first_li"><a href="?page=accstatus"><img src="images/deactivate.png" alt="Activate" /><span>Activate</span></a></li>';
}		
;echo '		
				<li><a href="?page=friends"><img src="images/ico_mana.png"  height="48" width="48" /><span>Friends List</span></a></li>
								<li><a href="?page=lostsn"><img src="images/sn.png"  /><span>Forget S.N?</span></a></li>
					<li><a href="?page=chat"><img height="48" width="48" src="images/ico_chat.png"  /><span>Live Chat</span></a></li>

				';
echo $supports;
;echo '';
if($status == 'Administrator'){
echo '<li><a href="?page=type"><img height="48" width="48" src="images/ico_fold.png" /><span>Block/Unblock</span></a></li>';
}
;echo '		


					
				</ul>
			</div><!-- end #shortcuts -->
			


			</div>
			<div id="sidebar" class="right">
				<h2 class="ico_mug">Characters Info</h2>

						
							';include('../includes/chars.php');;echo '
			
	

			</div><!-- end #sidebar -->
			
		</div><!-- end #content_main -->
				

		
		    <div  id="footer" class="clearfix">
    	
		<p class="left">&reg; ';echo ''.$Server_Name.' User Panel';;echo '</p>
		<p class="right">&copy; by <font class="style155"><a href="mailto:the_dragon20072008@hotmail.com">TheDragoN</a></font>. All rights reserved.</p>
	</div><!-- end #footer -->
</div><!-- end container -->
<br>

</body>
</html>
';
}
?>