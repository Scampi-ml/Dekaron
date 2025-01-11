<?php

echo '

 <style type="text/css">
.style11 {
	background-image: url(\'images/knight.png\');
}

.style31 {
	background-image: url(\'images/archer.png\');
}

.style21 {
	background-image: url(\'images/mage.png\');
}


.style10 {

	font-family = "Moderna.ttf";
	font-size: 12;



}



.style1 {
	margin-right: 3px;
		font-size: medium;
}


.style3 {
	font-family: "Monotype Corsiva";
	font-size: 15px;
	

}

.more {
	font-family: "Monotype Corsiva";
	font-size: 14px;
	

}

.style4 {
	font-family: "Monotype Corsiva";
	font-size: 16px;


}

.style155 {
	text-decoration: underline;


</style>


';
if(stristr($_SERVER['PHP_SELF'], 'chars.php')){
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
{
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_db,$username,$password);
}
$query = $db->Execute("SELECT
					Player.UID,
		            Player.GID,
					Player.PID,
					Player.Name,
					Player.Exp,
					Player.Level,
					Player.Class,
					Player.Specialty,
					Player.PUPoint,
					Player.SUPoint,
		Item.Num AS Num, Item.PID AS pids,
 Item.[Index] AS Indexs FROM Player LEFT JOIN
            Item 
        ON
            Item.PID = Player.PID And Item.[Index] = 924 And Item.[Info] != 16
 WHERE UID = '".$_SESSION['kal_id']."' 
ORDER BY Player.Level DESC
 ");
for($i=0;$i < $query->numrows();++$i)
{
$r = $query->fetchrow();
include('level.process.php');
$Names = $r[3];
$PID = $r[2];
$Level = $r[5];
$image = $r[6];
$UID = $_POST[0];
$PID = $_POST[2];
$pid = $r[2];
$guild = $r[1];
$Name = str_replace('<', '&lt;', $Names);
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
if($image == 0){
$image = '<table cellspacing="1" class="style11" style="width: 250px; height: 110px">';
}elseif($image == 1){
$image = '<table cellspacing="1" class="style21" style="width: 250px; height: 110px">';
}elseif($image == 2){
$image = '<table cellspacing="1" class="style31" style="width: 250px; height: 110px">';
}
if(empty($r[10])){
$mm = '0';
}
else{
$mm = number_format($r[10]);
}
echo '



'.$image.'



<tr>
		
		<td height=30px;><span class="style4"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name</span> :
<span class="style3"><strong><font color="#3575DF" >'.$Name.'</font></strong></span><br>
		
	</tr>



<tr>
		
		<td>		
<span class="style4">&nbsp;&nbsp;Level</span>&nbsp;&nbsp; :
<span class="style3"><strong><font color="#FF009C">'.$r[5].'</font></strong></span><br>

		
<span class="style4">&nbsp;&nbsp;Geon Bags</span> :
<span class="style3"><strong><font color="#6D670E">'.$mm.'</font></strong></span><br>

<span class="style4">&nbsp;&nbsp;Exp</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
<span> &nbsp;'.$design_2_1.'</span><br>



<span  class="more"><strong><font color="#00BAFF" ><a href=\'?page=info&amp;pid='.$r[2].'\'><center><font color="#B62828">More Info</a></font></strong></span><br>


	</tr>


</table>

<br>

';
}
if($image == ''){ 
echo '		 <link rel="stylesheet" type="text/css" href="images/chars.css"  />
			 
		<div class="msg msg-info">
									<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Characters In This Account.</p>
								</div>
	
	  


';
}
}
?>