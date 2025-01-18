<?php
    /*The connection page by Zombe.*/
    $MSSQLserverIP = '37.59.180.41'; // IP goes here
    $MSSQLusername = '0100000'; // MSSQL username goes here
    $MSSQLpassword = '000000'; // MSSQL password goes here
	
    $link = mssql_connect ("$MSSQLserverIP", "$MSSQLusername", "$MSSQLpassword");
    if(!$link)
    {
        die('Something went wrong while connecting to MSSQL');
    }
    mssql_select_db('account', $link);


	$MYSQLserverIP = 'localhost'; // IP goes here
	$MYSQLusername = 'xplic_ban_info'; // MYSQL username goes here
	$MYSQLpassword = 'player14'; // MYSQL password goes here
	
    mysql_connect("$MYSQLserverIP", "$MYSQLusername", "$MYSQLpassword") or die(mysql_error());
    mysql_select_db("xplicit_ban_info") or die(mysql_error());
	
	$foundersIP = '76.181.219.68'; //Your IP goes here
?>