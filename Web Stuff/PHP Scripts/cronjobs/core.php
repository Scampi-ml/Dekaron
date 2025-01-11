<?php
$db = new database_class();
$db->mssql_host = "xxxxx";
$db->mssql_user = "sa";
$db->mssql_pasw = "xxxxxxx";

$dir = dirname(__FILE__);

function charclass($class)
{
	$array_class = array(
		'0' => 'Azure Knight', 
		'1' => 'Segita Hunter', 
		'2' => 'Incar Magician', 
		'3' => 'Vicious Summoner', 
		'4' => 'Segnale', 
		'5' => 'Bagi Warrior', 
		'6' => 'Aloken',
		'10' => 'Concerra Summoner',
		'11' => 'Seguriper'
		); 
	return $array_class[$class];
}


$files = scandir($dir);
foreach($files as $file)
{
	if($file == '.'){continue;}
	if($file == '..'){continue;}
	if($file == 'cache'){continue;}
	if($file == 'core.php'){continue;}

	require_once ($file);  
}

class database_class
{
	var $the_mssql_query;
	var $the_mssql_link;
	var $mssql_host;
	var $mssql_user;
	var $mssql_pasw;
	var $persistent;
	
	function SQLconnect()
	{	
		@$this->the_mssql_link = mssql_pconnect($this->mssql_host, $this->mssql_user, $this->mssql_pasw) or die($this->SQLerror('Connection with SQL Server could not be established.'));
	}

	function SQLquery()
	{
	
		$this->SQLconnect();
		$args = func_get_args();
		$num = func_num_args();
		if($num > 1)
		{
			$array = array();
			for($i=1;$i < $num; $i++)
			{	
				// Escape all input data.
				$array[] = preg_replace('/\'/','\'\'', $args[$i]);
			}
			
			@$result = mssql_query(vsprintf($args[0], $array)) or die($this->SQLerror('The database can not run your request, please try again later.<br>SQL Error: <b>'.mssql_get_last_message().' '));
			
		}
		else
		{
			@$result = mssql_query($args[0]) or die($this->SQLerror('The database can not run your request, please try again later.<br>SQL Error: <b>'.mssql_get_last_message().' '));
		}
		
		
		if(!$result)
		{
			return mssql_get_last_message();	
		}
		else
		{
			return $result;
		}
		$this->SQLclose();
	}
	
	function SQLfetchArray($result)
	{
		$return = mssql_fetch_array($result);
		return $return;
	}
	
	function SQLfetchRow($result)
	{
		$return = mssql_fetch_row($result);
		return mssql_fetch_row($result);		
	}
	
	function SQLfetchNum($result)
	{
		$return = mssql_num_rows($result);
		return $return;
	}
	
	function SQLerror($error)
	{
		return $error;
	}
			
	function SQLclose()
	{
		mssql_close($this->the_mssql_link);
	}
	
	function addfile($filename, $data)
	{
		@file_put_contents('cache/'.$filename.'', $data);
	}
	
	
}
?> 