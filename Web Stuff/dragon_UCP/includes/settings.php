<?php

if(stristr($_SERVER['PHP_SELF'], "settings.php")){
exit("<strong>Error: </strong>Can't be opened directly!");
}


$connection = "odbc"; // connection with (mssql or odbc)

$server = ""; //database server / host

$username = ""; //database username defcult "sa"

$password = ""; //database password

$kal_auth = "KAL_AUTH"; //database of accounts defcult "kal_auth"

$kal_db = "KAL_DB"; //database of characters defcult "kal_db"

$Server_Name = "crap crap";
$Server_Site = "http://crapcrap.com";



$Email_Host = "smtp.mail.yahoo.com";
$Email_Username = "crapcrap@yahoo.com";
$Email_Password = "Register1";
$Email_From = "crapcrap@yahoo.com";
$Email_FromName = $Server_Name;

?>





