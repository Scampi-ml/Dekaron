<?php 
if(basename($_SERVER["PHP_SELF"]) == "mssql.php"){
	die("403 - Access Forbidden");
}

$host = "localhost";
$user = "sa";
$pass = "server";
$db = "dkcms";
$conn2 = mssql_connect($host,$user,$pass);	

?>