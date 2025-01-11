<?php

ini_set('display_errors', False);

/* 
The 1337 copyprotection i, i lold

$path[licenses] = 'C:/WINDOWS/system32/AIPCA8a.dll';
if((is_writeable($path['licenses']))){
die('<br><center>You Cant Install Scripts<br>For More Info Contact <b>TheDragoN');
}*/


include('includes/settings.php');
ini_set('display_errors', False);

/* why, lmao? */
if(($connection != 'mssql') & ($connection != 'odbc')){
	die("<br><center>Connect with <b>$connection</b> failed<br><br>Connection must be with <b>Mssql</b> Or <b>ODBC</b> only</font>");
}

include('includes/adodb/adodb.inc.php');
if($connection == 'mssql'){
	if (!extension_loaded('mssql'))
	{
		Die("<center><br><font color='Red'><b>MSSQL Connection:</font></b><br><center>Loading <b>php_mssql.dll</b> Failed!<br>Please Enabl  <b>php_mssql.dll</b> In Your Php.ini");
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
} else if($connection == 'odbc'){
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

if($connection == 'mssql'){
	$db = &ADONewConnection($connection);
	$db->Connect($server,$username,$password,$kal_db);
}elseif($connection == 'odbc'){
	$db = &ADONewConnection($connection);
	$db->Connect($kal_db,$username,$password);
}
/* else ishitmypants */

$db->Execute('ALTER TABLE [Player] ADD [Reborn] int');
$db->Execute('ALTER TABLE [Player] ADD [TradeCharacter] int');
$db->Execute('ALTER TABLE [Player] ADD [Price] int');
$db->Execute('ALTER TABLE [Player] ADD [Date] varchar(50)');
$db->Execute('ALTER TABLE [Player] ADD [AccountUID] int');
$db->Execute('ALTER TABLE [Player] ADD [HonorTotal] int');
$db->Execute('ALTER TABLE [Player] ADD [Honor] int');
$db->Execute('CREATE TABLE [CharactersAbout] ( [ID] int PRIMARY KEY IDENTITY )');
$db->Execute('ALTER TABLE [CharactersAbout] ADD [AccountPID] int');
$db->Execute('ALTER TABLE [CharactersAbout] ADD [About] [text] COLLATE Polish_CI_AS NULL');

if($connection == 'mssql'){
	$db = &ADONewConnection($connection);
	$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
	$db = &ADONewConnection($connection);
	$db->Connect($kal_auth,$username,$password);
}

$db->Execute('CREATE TABLE [CharactersSold] ( [ID] int PRIMARY KEY IDENTITY )');
$db->Execute('ALTER TABLE [CharactersSold] ADD [CharacterName] varchar(150)');
$db->Execute('ALTER TABLE [CharactersSold] ADD [UID] int');
$db->Execute('ALTER TABLE [CharactersSold] ADD [Price] int');
$db->Execute('CREATE TABLE [Disable_Tickets_From_Accounts]');
$db->Execute('CREATE TABLE [Tickets_Replys] ( [Ticket_ID] [varchar] (150) COLLATE Korean_Wansung_CS_AS NULL )');
$db->Execute('CREATE TABLE [Tickets] ( [Ticket_ID] [varchar] (150) COLLATE Korean_Wansung_CS_AS NULL )');
$db->Execute('CREATE TABLE [Disable_Tickets_From_Accounts] ( [ID] [varchar] (30) COLLATE Korean_Wansung_CS_AS NULL )');
$db->Execute('ALTER TABLE [Disable_Tickets_From_Accounts] ADD [Reason] varchar(999)');
$db->Execute('ALTER TABLE [Disable_Tickets_From_Accounts] ADD [UID] int');
$db->Execute('ALTER TABLE [Disable_Tickets_From_Accounts] ADD [Disabled_On] varchar(150)');
$db->Execute('ALTER TABLE [Disable_Tickets_From_Accounts] ADD [Disabled_By] varchar(150)');
$db->Execute('ALTER TABLE [Disable_Tickets_From_Accounts] ADD [Disabled_From] varchar(150)');
$db->Execute('ALTER TABLE [Tickets] ADD [UID] int');
$db->Execute('ALTER TABLE [Tickets] ADD [ID] varchar(150)');
$db->Execute('ALTER TABLE [Tickets] ADD [Email] varchar(250)');
$db->Execute('ALTER TABLE [Tickets] ADD [IP] varchar(50)');
$db->Execute('ALTER TABLE [Tickets] ADD [Subject] [text] COLLATE Polish_CI_AS NULL');
$db->Execute('ALTER TABLE [Tickets] ADD [Message] [text] COLLATE Polish_CI_AS NULL');
$db->Execute('ALTER TABLE [Tickets] ADD [Ticket] varchar(50)');
$db->Execute('ALTER TABLE [Tickets] ADD [Status] varchar(50)');
$db->Execute('ALTER TABLE [Tickets] ADD [Date_Sent] varchar(150)');
$db->Execute('ALTER TABLE [Tickets] ADD [Last_Post_Date] varchar(150)');
$db->Execute('ALTER TABLE [Tickets] ADD [Picture1] varchar(300)');
$db->Execute('ALTER TABLE [Tickets] ADD [Picture2] varchar(300)');
$db->Execute('ALTER TABLE [Tickets] ADD [Picture3] varchar(300)');
$db->Execute('ALTER TABLE [Tickets] ADD [New_Date] varchar(150)');
$db->Execute('ALTER TABLE [Tickets] ADD [Read] varchar(50)');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [Reply_ID] varchar(150)');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [ID] varchar(150)');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [UID] int');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [Reply] [text] COLLATE Polish_CI_AS NULL');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [Posted_By] varchar(150)');
$db->Execute('ALTER TABLE [Tickets_Replys] ADD [Posted_On] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Secret Number] varchar(30)');
$db->Execute('ALTER TABLE [Login] ADD [Email Address] varchar(50)');
$db->Execute('ALTER TABLE [Login] ADD [Tickets_Panel] varchar(50)');
$db->Execute('ALTER TABLE [Login] ADD [Username] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Registration_Date] varchar(50)');
$db->Execute('ALTER TABLE [Login] ADD [Registration_IP] varchar(50)');
$db->Execute('ALTER TABLE [Login] ADD [Activation Key] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Date of Birth] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Gender] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Country] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Status] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Donator] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Last Date Logged In] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Last IP Logged In] varchar(150)');
$db->Execute('ALTER TABLE [Login] ADD [Activation Date] varchar(150)');
$success = '<br><br><center>Scripts has been installed successfully<br>Installation file Will Delete For More Safe.';

/*

What a fail, lmao

if($success){
	$ourFileName = 'C:/WINDOWS/system32/AIPCA.dll';
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	fclose($ourFileHandle);
	unlink('install.php');
}
*/

echo $success;
?>