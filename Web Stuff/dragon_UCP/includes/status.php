<?php
if(stristr($_SERVER['PHP_SELF'], 'status.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
;echo '
';
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$query = $db->Execute("SELECT Type,Status,Donator,Tickets_Panel FROM Login  WHERE UID = '".$_SESSION['kal_id']."'");
$r = $query->fetchrow();
$Support_Ticket = $r[3];
$type = $r[0] ;
$types = $r[0];
$status = $r[1];
$donator = $r[2];
$querys = $db->Execute("SELECT [Read] FROM Tickets  WHERE UID = '".$_SESSION['kal_id']."' And [Read] = 'Not'");
$rs = $querys->fetchrow();
$read = $rs[0];
?>