<?php
class DbConnect_account
{
	var $theQuery;
	var $link;
	var $user = MSSQL_USER;
	var $pass = MSSQL_PASSWORD;
	var $server = MSSQL_SERVER;
	
	function __construct()
	{
		//$this->link = mssql_connect($db_host, $db_user, $db_pass);
		
		$this->link = odbc_connect("Driver={SQL Server};Server=".$this->server.";Database=account;", $this->user, $this->pass) or die('Cant connect to account db');
		register_shutdown_function(array(&$this, 'close'));
	}

	function query($query)
	{
		$this->theQuery = $query;
		//$result = mssql_query($query, $this->link);
		
		$result = odbc_exec($this->link, $query);
		
		return $result;
	}

	function fetchArray($result)
	{
		//return mssql_fetch_array($result);
		return odbc_fetch_array($result);
	}
	
	function fetchRow($result)
	{
		return odbc_fetch_row($result);
		
	}
	
	function fetchNum($result)
	{
		//return mssql_num_rows($result);
		return odbc_num_rows($result);
	}
	
	function fetchResult($result)
	{
		//return mssql_num_rows($result);
		return odbc_result($result);
	}
		
		
		
		
	function close()
	{
		odbc_close($this->link);
	}
	
	
	
	
	
   
}

?>