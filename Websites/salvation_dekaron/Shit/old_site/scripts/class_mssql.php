<?php
$db = new database_class();

$db->mssql_host = '37.59.180.41';
$db->mssql_user = 'SaBaker1893';
$db->mssql_pasw = 'ImPP8pL0h';		

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
		$this->the_mssql_link = @mssql_pconnect($this->mssql_host, $this->mssql_user, $this->mssql_pasw);
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
				$array[] = preg_replace('/\'/','\'\'', $args[$i]);
			}
			@$result = @mssql_query(vsprintf($args[0], $array));
		}
		else
		{
			@$result = @mssql_query($args[0]);
		}
		
		if(!$result)
		{
			return @mssql_get_last_message();	
		}
		else
		{
			return $result;
		}
		$this->SQLclose();
	}
	
	function SQLfetchArray($result)
	{
		return  @mssql_fetch_array($result);
	}
	
	function SQLfetchRow($result)
	{
		return @mssql_fetch_row($result);		
	}
	
	function SQLfetchNum($result)
	{
		return  @mssql_num_rows($result);
	}
				
	function SQLclose()
	{
		@mssql_close($this->the_mssql_link);
	}
}
?> 