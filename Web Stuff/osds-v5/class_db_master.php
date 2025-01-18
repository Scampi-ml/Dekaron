<?php
class DbConnect_master
{
	var $theQuery;
	var $link;
	var $user = MSSQL_USER;
	var $pass = MSSQL_PASSWORD;
	var $server = MSSQL_SERVER;
	
	function __construct()
	{
		$this->link = odbc_connect("Driver={SQL Server};Server=".$this->server.";Database=master;", $this->user, $this->pass);
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
		return odbc_fetch_array($result);
	}
	
	function fetchRow($result)
	{
		return odbc_fetch_row($result);
	}

	function fetchNum($result)
	{
		return odbc_num_rows($result);
	}
	
	function close()
	{
		odbc_close($this->link);
	}
   
}

?>