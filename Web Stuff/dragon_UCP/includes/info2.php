<?php

echo ' 
<style type="text/css">



#info {
width:600px;
height: 400px;
background:url(images/info2.png);
}

#info_txt {
width: 450px; 
height:50px;
margin: 20px 20px 20px 20px;
float:left;
}


#hp {
width: 150px; 
height:20px;
float:left;
margin: 66px 0px 0px 205px;
}



#mp {
width: 50px; 
height:20px;
float:left;
margin: 105px 0px 0px -150px;
}

.str {
width: 60px; 
height: 20px;
float:left;
margin: 155px 0px 0px -252px;
}
.heal {
width: 60px; 
height: 20px;
float:left;
margin: 192px 0px 0px -252px;
}
.int {
width: 120px; 
height: 20px;
float:left;
margin: 228px 0px 0px -252px;
}
.wis {
width: 120px; 
height: 20px;
float:left;
margin: 263px 0px 0px -252px;
}

.agi {
width: 120px; 
height: 20px;
float:left;
margin: 301px 0px 0px -252px;
}

.skill {
width: 120px; 
height: 20px;
float:left;
margin: 155px 0px 0px -52px;
}

.state {
width: 120px; 
height: 20px;
float:left;
margin: 192px 0px 0px -120px;
}
.cb {
width: 120px; 
height: 20px;
float:left;
margin: 228px 0px 0px -120px;
}


.back {
width: 120px; 
height: 20px;
float:left;
margin: 342px 0px 0px -400px;

 text-shadow:black 0px 0px 1px; font-size:20px;

font-family: "Monotype Corsiva";

}





</style>


';
$PID = $_GET['pid'];
if(stristr($_SERVER['PHP_SELF'], 'info2.php')){
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
if(!is_numeric($PID)) {
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("URL Contain Illegal Characters.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else 
{
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$query = $db->Execute("SELECT
					Player.Strength,
					Player.Health,
					Player.Intelligence,
					Player.Wisdom,
					Player.Dexterity,
					Player.CurHP,
					Player.CurMP,
					Player.PUPoint,
					Player.SUPoint,
					Player.Contribute,
					Player.PID

				FROM
					Player

				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."'



			      ");
$r = $query->fetchrow();
$pid = $r[10];
if(empty($pid)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("There Something Wrong, You Cant View Info Of This Character.")
		window.location = "index.php";
</SCRIPT>';
exit();
} else {
echo '
<div id="info">


     <div id="hp" ><font color="#676767"><b>'.$r[5].'</div>
   <div id="mp" >'.$r[6].'</div>

     <div class="str" >'.$r[0].'</div>
     <div class="heal" >'.$r[1].'</div>
     <div class="int" >'.$r[2].'</div>

     <div class="wis" >'.$r[3].'</div>
     <div class="agi" >'.$r[4].'</div>
     <div class="skill" >'.$r[8].'</div>
     <div class="state" >'.$r[7].'</div>
     <div class="cb" >'.$r[9].'</font></b></div>
     <div class="back" ><a href=\'?page=info&amp;pid='.$r[10].'\'><font color="#C32A1F"><< Back</font></a></div>




</div>


';
}
}
;echo '
';?>