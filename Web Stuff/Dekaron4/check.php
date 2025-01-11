<?php
// This is a code to check the username from a mysql database table

// Please fill in your MSSQL Info
//<--! begin MSSQL info !-->
$mssql = array(
		'host' => "localhost",	// Normaly "localhost" or "XXX.XXX.XXX.XXX"
		'user' => "sa",			// Your username for MSSQL server, normaly "sa"
		'pass' => "server"		// Your password for MSSQL server
	);
//<--! ind MSSQL info !-->


if(isSet($_POST['username']))
{
$username = $_POST['username'];

$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
$sql_check = mssql_query("SELECT character_name FROM character.dbo.user_character WHERE character_name='$username'",$ms_con);

if(mssql_num_rows($sql_check))
{
echo 'OK';
}
else
{
echo '<span style="color: red;">The character name "<b>'.$username.'</b>" does not exist.</span>';
}}
?>
