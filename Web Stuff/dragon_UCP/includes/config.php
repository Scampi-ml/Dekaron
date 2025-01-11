<?php
if(stristr($_SERVER['PHP_SELF'], 'config.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}

$path[licenses] = '';
$path[license] = '';

/*

crap? lmao

$path[licenses] = 'C:/WINDOWS/system32/AIPCA8a.dll';
if((is_writeable($path['licenses']))){
die('<br><center>Scripts Not Available<br>For More Info Contact <b>TheDragoN');
}
$path[license] = 'C:/WINDOWS/system32/AIPCA.dll';
if((!is_writeable($path['license']))){
die('<br><center>Scripts Not Available<br>For More Info Contact <b>TheDragoN');
}
*/

if (isset($_GET['logout']))
{
function jump($location)
{
header('Location: '.$location.'');
}
session_destroy();
jump('index.php');
}
include('settings.php');
ini_set('display_errors',False);
if(($connection != 'mssql') & ($connection != 'odbc')){
die("<br><center>Connect with <b>$connection</b> failed<br><br>Connection must be with <b>Mssql</b> Or <b>ODBC</b> only</font>");
}
include('adodb/adodb.inc.php');
if($connection == 'mssql'){
if (!extension_loaded('mssql'))
{
Die("<center><br><font color='Red'><b>MSSQL Connection:</font></b><br><center>Loading <b>php_mssql.dll</b> Failed!<br>Please Enable <b>php_mssql.dll</b> In Your Php.ini");
}
$db = &ADONewConnection($connection);
$connect_mssql = $db->Connect($server,$username,$password);
$checkkal_db = $db->Connect($server,$username,$password,$kal_db);
$checkkal_auth = $db->Connect($server,$username,$password,$kal_auth);
if (!$connect_mssql){
die("<br><center>Connection with <b>Mssql</b> failed<br><font color='red'> Check Settings </font>");
}
if (!$checkkal_auth)
{
die('<br><center>Cant Connect To <b>'.$kal_auth.'</b> Database');
}
if (!$checkkal_db)
{
die('<br><center>Cant Connect To <b>'.$kal_db.'</b> Database');
}
}else
if($connection == 'odbc'){
if (!extension_loaded('gd')){
Die("<center><br><font color='Red'><b>ODBC Connection:</font></b><br><b>Loading php_gd2.dll</b> Failed!<br>Please Enable <b>php_gd2.dll</b> In Your Php.ini");
}
$db = &ADONewConnection($connection);
$connect_odbc = $db->Connect($kal_db,$username,$password);
if (!$connect_odbc)
{
die("<br><center>Connection with <b>ODBC</b> ($kal_db) Databasefailed<br><font color='red'> Check Settings Or Use Mssql Connection</font>");
}
$db2 = &ADONewConnection($connection);
$connect_odbc22 = $db2->Connect($kal_auth,$username,$password);
if (!$connect_odbc22)
{
die("<br><center>Connection with <b>ODBC</b> ($kal_auth) Database failed<br><font color='red'> Check Settings Or Use Mssql Connection</font>");
}
}
require_once('geoiploc.php');
require_once ('functions.php');
SQLinject($_GET['do']);
SQLinject($_GET['loginerror']);
SQLinject($_GET['site']);
SQLinject($_GET['page']);
SQLinject($_GET['go']);
SQLinject($_GET['id']);
SQLinject($_GET['pid']);
SQLinject($_GET['activekey']);
SQLinject($_GET['Tickets_Panel']);
require_once ('check.php');
;echo '



';?>