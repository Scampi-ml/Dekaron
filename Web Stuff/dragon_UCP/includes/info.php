<?php

echo ' 
<style type="text/css">



#info {
width:600px;
height: 480px;
background:url(images/info.png);
}

#info_txt {
width: 450px; 
height:50px;
margin: 20px 20px 20px 20px;
float:left;
}


#name {
width: 150px; 
height:20px;
float:left;
margin: 62px 0px 0px 146px;
}



#class {
width: 50px; 
height:20px;
float:left;
margin: 105px 0px 0px -180px;
}
#job {
width: 120px; 
height:20px;
float:left;
margin: 105px 0px 0px -45px;
}
#level {
width: 40px; 
height: 20px;
float:left;
margin: 148px 0px 0px -254px;
}
#rg {
width: 40px; 
height: 20px;
float:left;
margin: 147px 0px 0px -119px;
}

.exp {
width: 60px; 
height: 20px;
float:left;
margin: 185px 0px 0px -224px;
}
.expb {
width: 120px; 
height: 20px;
float:left;
margin: 225px 0px 0px -227px;
}
.expb2 {
width: 120px; 
height: 20px;
float:left;
margin: 222px 0px 0px -120px;
}

.guild {
width: 120px; 
height: 20px;
float:left;
margin: 262px 0px 0px -225px;
}
.position {
width: 120px; 
height: 20px;
float:left;
margin: 305px 0px 0px -225px;
}


.honorpu {
width: 120px; 
height: 20px;
float:left;
margin: 350px 0px 0px -183px;
}
.thonorpu {
width: 120px; 
height: 20px;
float:left;
margin: 379px 0px 0px -119px;
}
.thonorpum {
width: 120px; 
height: 20px;
float:left;
margin: 409px 0px 0px -92px;
}
.next {
width: 120px; 
height: 20px;
float:left;
margin: 445px 0px 0px -110px;

 text-shadow:black 0px 0px 1px; font-size:20px;

font-family: "Monotype Corsiva";

}





</style>


';
$PID = $_GET['pid'];
if(stristr($_SERVER['PHP_SELF'], 'info.php')){
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
$pll = $db->Execute("SELECT
 GuildMember.Class

       FROM
            GuildMember


      WHERE
PID = '$PID'");
$rs = $pll->fetchrow();
$classguild = $rs[0];
$position = $classguild;
$query = $db->Execute("SELECT
					Player.UID,
		            Player.GID,
					Player.PID,
					Player.Name,
					Player.Exp,
					Player.Level,
					Player.Class,	
					Player.Specialty,					
Guild.Name AS GuildName,
Guild.Leader AS GuildLeader,
Guild.SubLeader AS GuildSubLeader,
Guild.Centurion AS GuildCenturion,
Guild.Ten AS GuildTen,
Guild.Regular AS GuildRegular,
Guild.Temp AS GuildTemp,
Player.Reborn,
Player.Honor,
Player.HonorTotal



				FROM
					Player
LEFT JOIN
            Guild

        ON
            Guild.GID = Player.GID

				WHERE
					PID = '$PID' And UID = '".$_SESSION['kal_id']."' ");
$r = $query->fetchrow();
$pids = $r[2];
if(empty($pids)){ 
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("There Something Wrong, You Cant View Info Of This Character.")
		window.location = "index.php";
</SCRIPT>';
exit();
} else {
include('level.process.php');
if($r[6] == 0){
$job = 'Knight';
}elseif($r[6] == '1'){
$job = 'Magician';
}elseif($r[6] == '2'){
$job = 'Archer';
};
if(empty($position)){
$position1 = '-';
}else if($position == '1'){
$position1 = ''.$r[9].'';
}else if($position == '2'){
$position1 = ''.$r[10].'';
}else if($position == '3'){
$position1 = ''.$r[11].'';
}else if($position == '4'){
$position1 = ''.$r[12].'';
}else if($position == '5'){
$position1 = ''.$r[13].'';
}else if($position == '6'){
$position1 = ''.$r[14].'';
}else if($position == '2'){
$position1 = 'Sub Leader';
};
if(empty($r[8])){
$guildd = '-';
}
else{
$guildd = ''.$r[8].'';
}
if(empty($r[4])){
$exp = '0';
}
else{
$exp = ''.$r[4].'';
}
if(empty($r[15])){
$reborn = '-';
}
else{
$reborn = ''.$r[15].'';
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
$HonorUsed = $r[17] - $r[16];
if(empty($r[17])){
$toha = '0';
}
else{
$toha = ''.$r[17].'';
}
if(empty($r[16])){
$tohasa = '0';
}
else{
$tohasa = ''.$r[16].'';
}
$Names = $r[3];
$Name = str_replace('<', '&lt;', $Names);
echo '
<div id="info">


     <div id="name" ><font color="#676767"><b>'.$Name.'</div>
   <div id="class" >'.$job.'</div>
     <div id="job">'.$class.'</div>
   <div id="level">'.$r[5].'</div>
     <div id="rg" >'.$reborn.'</div>
     <div class="exp" ><font color="#676767"><b>'.$exp.'</div>
     <div class="expb" ><font color="#676767"><b>'.$design_2_1.'</div>
     <div class="expb2" ><font color="#676767"><b>'.$design_1_1.'</div>

     <div class="guild" ><font color="#676767"><b>'.$guildd.'</div>
     <div class="position" ><font color="#676767"><b>'.$position1.'</font></b></div>
	      <div class="honorpu" ><font color="#676767"><b>'.$HonorUsed.'</div>
		    <div class="thonorpu" ><font color="#676767"><b>'.$toha.'</div>
			<div class="thonorpum" ><font color="#676767"><b>'.$tohasa.'</div>
			
     <div class="next" ><a href=\'?page=info2&amp;pid='.$r[2].'\'><font color="#C32A1F">Next >></font></a></div>




</div>


';
} 
}
;echo '
';?>