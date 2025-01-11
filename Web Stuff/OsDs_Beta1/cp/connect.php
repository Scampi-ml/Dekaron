<?php
    /*The connection page by Zombe.*/
    $MSSQLserverIP = 'localhost'; // IP goes here
    $MSSQLusername = 'sa'; // MSSQL username goes here
    $MSSQLpassword = 'server'; // MSSQL password goes here
	
    $link = mssql_connect ("$MSSQLserverIP", "$MSSQLusername", "$MSSQLpassword");
    if(!$link)
    {
        die('Something went wrong while connecting to MSSQL');
    }
    mssql_select_db('account', $link);


	$MYSQLserverIP = 'localhost'; // IP goes here
	$MYSQLusername = 'root'; // MYSQL username goes here
	$MYSQLpassword = 'server'; // MYSQL password goes here
	
    mysql_connect("$MYSQLserverIP", "$MYSQLusername", "$MYSQLpassword") or die(mysql_error());
    mysql_select_db("ban_info") or die(mysql_error());
	
//	$foundersIP = '192.168.1.102'; //Your IP goes here
?>