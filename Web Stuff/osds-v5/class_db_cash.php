<?php
class DbConnect_cash
{
	var $theQuery;
	var $link;
	var $user = MSSQL_USER;
	var $pass = MSSQL_PASSWORD;
	var $server = MSSQL_SERVER;
	
	function __construct()
	{
		//$this->link = mssql_connect($db_host, $db_user, $db_pass);
		
		$this->link = odbc_connect("Driver={SQL Server};Server=".$this->server.";Database=cash;", $this->user, $this->pass);
		register_shutdown_function(array(&$this, 'close'));
	}

	function query($query)
	{
		$this->theQuery = $query;
		$result = odbc_exec($this->link, $query);
		return $result;
	}

	function fetchArray($result)
	{
		$return = odbc_fetch_array($result);
		return $return;
	}
	
	function fetchRow($result)
	{
		$return = odbc_fetch_array($result);
		return $return;
	}

	function fetchNum($result)
	{
		$return = odbc_num_rows($result);
		return $return;
	}
	
	function close()
	{
		odbc_close($this->link);
	}
   
}

?>